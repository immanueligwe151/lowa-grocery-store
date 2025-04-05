<?php
session_start();
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredCaptcha = $_POST['captcha'] ?? '';
    $correctCaptcha = $_SESSION['captcha_answer'] ?? '';

    if (strcasecmp($enteredCaptcha, $correctCaptcha) !== 0) {
        echo json_encode(['success' => false, 'error' => 'Incorrect CAPTCHA.']);
        exit;
    }

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        echo json_encode(["success" => false, "error" => "Email and password are required."]);
        exit;
    }

    $stmt = $conn->prepare("SELECT customer_id, customer_password FROM `Customers` WHERE customer_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['customer_password'])) {
            $_SESSION['user_logged_in'] = true;
            $_SESSION['customer_id'] = $row['customer_id'];

            header("Location: ../index.php");
            exit();
        } else {
            echo json_encode(["success" => false, "error" => "Invalid password."]);
        }
    } else {
        echo json_encode(["success" => false, "error" => "No account found with that email."]);
    }
}
?>
