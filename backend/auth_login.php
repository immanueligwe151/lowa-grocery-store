<?php
session_start();
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredCaptcha = $_POST['captcha'] ?? '';
    $correctCaptcha = $_SESSION['captcha_answer'] ?? '';

    if (strcasecmp($enteredCaptcha, $correctCaptcha) !== 0) {
        $_SESSION['captcha_error'] = 'Incorrect CAPTCHA, please try again.';
        header("Location: ../frontend/login.php");
        exit();
    }

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email)) {
        $_SESSION['email_error'] = 'Email and password are both required.';
        header("Location: ../frontend/login.php");
        exit();
    }

    if (empty($password)) {
        $_SESSION['password_error'] = 'Email and password are both required.';
        header("Location: ../frontend/login.php");
        exit();
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
            $_SESSION['password_error'] = 'Your password is incorrect, please try again.';
            header("Location: ../frontend/login.php");
            exit();
        }
    } else {
        $_SESSION['email_error'] = 'No account with that email was found, please try again.';
        header("Location: ../frontend/login.php");
        exit();
    }
}
?>
