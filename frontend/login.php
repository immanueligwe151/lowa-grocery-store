<?php
session_start();

include('../backend/connection.php');
$email_error = isset($_SESSION['email_error']) ? $_SESSION['email_error'] : null;
unset($_SESSION['email_error']);
$password_error = isset($_SESSION['password_error']) ? $_SESSION['password_error'] : null;
unset($_SESSION['password_error']);
$captcha_error = isset($_SESSION['captcha_error']) ? $_SESSION['captcha_error'] : null;
unset($_SESSION['captcha_error'])
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lowa | Login</title>
        <meta name="description" content="Lowa, an online grocery store for lower prices and higher savings.">
        <meta name="keywords" content="grocery, online grocery shopping, cheap, low prices, delivery, pickup, Lowa">
        <link rel="icon" href="https://i.postimg.cc/L87TFDYM/lowa-logo.png" type="image/x-icon">
        <link rel="stylesheet" href="./css/styles.css">
    </head>
    <body class="login">
        <header>
            <img src="https://i.postimg.cc/pLZmDLvc/lowa-image.png" alt="lowa logo">
            <h4>The shop for all your grocery needs</h4>
        </header>

        <nav>
            <a class="nav-link" href="..">Home</a>
            <a class="nav-link selected">Login</a>
        </nav>

        <section>
            <h2>Login</h2>
        </section>

        <section>
            <form method="POST" action="../backend/auth_login.php">
                <div class="form-fields">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                    <?php if ($email_error): ?>
                        <p class="error-message"><?php echo $email_error; ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-fields">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                    <?php if ($password_error): ?>
                        <p class="error-message"><?php echo $password_error; ?></p>
                    <?php endif; ?>
                </div>

                <div style="text-align: center;">
                    <h3>Don't have an account? <a href="./signup.php">Sign up here</a></h3>
                </div>
                
                <div id="captcha-div">
                    <label for="captcha">Enter the characters shown:</label>
                    <img id="captcha-image" src="" alt="CAPTCHA">
                    <input type="text" id="captcha" name="captcha" placeholder="Enter CAPTCHA here"required>
                    <?php if ($captcha_error): ?>
                        <p class="error-message"><?php echo $captcha_error; ?></p>
                    <?php endif; ?>
                    <button type="button" id="captcha-button" onclick="loadCaptcha()">Refresh CAPTCHA</button>
                </div>

                <input type="submit" class="form-submit" value="Log in">
            </form>
        </section>
    </body>
    <script src="./js/script.js"></script>
</html>