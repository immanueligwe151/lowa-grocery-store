<?php
session_start();

include('../backend/connection.php');
$error_message = isset($_SESSION['login_error']) ? $_SESSION['login_error'] : null;
unset($_SESSION['login_error'])
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lowa | Login</title>
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
            <?php if ($loggedIn): ?>
                <a class="nav-link">My Basket</a>
                <a class="nav-link">My Account</a>
                <a class="nav-link">My Orders</a>
            <?php else: ?>
                <a class="nav-link">Login</a>
            <?php endif; ?>
        </nav>

        <section>
            <div>
                <h3>Login</h3>
            </div>
            <div>
                <form method="POST" action="../backend/auth_login.php">
                    <div class="form-fields">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                        <p class="error-message" id="email-error"></p>
                    </div>

                    <div class="form-fields">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                        <p class="error-message" id="password-error"></p>
                    </div>

                    <div>
                        <h3>Don't have an account? <a href="./signup.php">Sign up here</a></h3>
                    </div>
                    
                    <div>
                        <label for="captcha">Enter the characters shown:</label>
                        <img id="captcha-image" src="" alt="CAPTCHA">
                        <input type="text" id="captcha" name="captcha" required>
                        <p class="error-message" id="captcha-error"></p>
                        <button type="button" onclick="loadCaptcha()">Refresh CAPTCHA</button>
                    </div>

                    <?php if ($error_message): ?>
                        <p class="error-message"><?php echo $error_message; ?></p>
                    <?php endif; ?>

                    <input type="submit" value="Log in">
                </form>
            </div>
        </section>
    </body>
    <script src="./js/script.js"></script>
</html>