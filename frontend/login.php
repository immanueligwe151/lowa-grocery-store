<?php
session_start();

include('../backend/connection.php');

$loggedIn = isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lowa | Login</title>
        <link rel="icon" href="https://i.postimg.cc/L87TFDYM/lowa-logo.png" type="image/x-icon">
        <link rel="stylesheet" href="./frontend/css/styles.css">
    </head>
    <body class="home">
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
                <form>
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

                    <input type="submit" value="Log in">
                </form>
            </div>
        </section>
    </body>
    <script src="./frontend/js/script.js"></script>
</html>