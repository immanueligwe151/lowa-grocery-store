<?php
session_start();

include('./backend/auth_signup.php');
//echo (__DIR__);

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
        <link rel="stylesheet" href="./css/styles.css">
        <script src="https://unpkg.com/react@18/umd/react.development.js" crossorigin></script>
        <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js" crossorigin></script>

        <!-- Babel for JSX support -->
        <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>

        <!-- Your React Signup Component -->
        <script type="text/babel" src="./js/signupForm.js"></script>
    </head>
    <body class="signup">
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
            <div id="signup-root"></div>
        </section>
    </body>
    <script src="./js/script.js"></script>
</html>