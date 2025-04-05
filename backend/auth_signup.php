<?php
include(__DIR__ . '/connection.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $number = trim($_POST['number'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password1 = $_POST['password-1'] ?? '';
    $password2 = $_POST['password-2'] ?? '';

    if ($password1 !== $password2) {
        echo json_encode(['success' => false, 'message' => 'Passwords do not match']);
        exit;
    }

    if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        echo json_encode(['success' => false, 'message' => 'Name must contain only letters']);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email format']);
        exit;
    }

    //to hash the password before saving user
    $hashedPassword = password_hash($password1, PASSWORD_BCRYPT);
    $customerId = generateCustomerID();

    $stmt = $conn->prepare("INSERT INTO `Customers` (customer_id, customer_name, customer_email, customer_phone, customer_password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $customerId, $name, $email, $number, $hashedPassword);

    if ($stmt->execute()) {
        $_SESSION['user_logged_in'] = true;
        $_SESSION['customer_id'] = $customerId;

        header("Location: ../index.php");
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}


function generateCustomerID() {
    $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $digits = '0123456789';

    $part1 = $letters[random_int(0, 25)];
    $part1 .= $digits[random_int(0, 9)];
    $part1 .= $digits[random_int(0, 9)];

    $part2 = $letters[random_int(0, 25)];
    $part2 .= $letters[random_int(0, 25)];
    $part2 .= $digits[random_int(0, 9)];
    $part2 .= $digits[random_int(0, 9)];

    return $part1 . '-' . $part2;
}
?>
