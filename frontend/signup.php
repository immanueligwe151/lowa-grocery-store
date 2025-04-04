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
        <script src="https://unpkg.com/react@18/umd/react.development.js" crossorigin></script>
        <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js" crossorigin></script>

        <!-- Babel for JSX support -->
        <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>

        <!-- Your React Signup Component -->
        <script type="text/babel" src="./js/signupForm.js"></script>
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
                <h3>Signup</h3>
            </div>
            <div id="signup-root">
                <!-- <form>
                    <div class="form-fields">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" required>
                        <p class="error-message" id="name-error">dfg</p>
                    </div>

                    <div class="form-fields">
                        <label for="number">Phone number:</label>
                        <input type="tel" id="number" name="number" required>
                        <p class="error-message" id="number-error">dfg</p>
                    </div>

                    <div class="form-fields">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                        <p class="error-message" id="email-error">dfg</p>
                    </div>

                    <div class="form-fields">
                        <label for="password-1">Password:</label>
                        <input type="password" id="password-1" name="password-1" required>
                        <p class="error-message" id="password-1-error">dfg</p>
                    </div>

                    <div class="form-fields">
                        <label for="password-2">Confirm password:</label>
                        <input type="password" id="password-2" name="password-2" required>
                        <p class="error-message" id="password-2-error">dfg</p>
                    </div>

                    <div>
                        <h3>Already have an account? <a href="./login.php">Log in here</a></h3>
                    </div>

                    <input type="submit" value="Log in">
                </form> -->
            </div>
        </section>
    </body>
    <script src="./frontend/js/script.js"></script>
</html>