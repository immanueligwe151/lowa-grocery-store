<?php

session_start();

$loggedIn = isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'];


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lowa | Signup</title>
        <meta name="description" content="Lowa, an online grocery store for lower prices and higher savings.">
        <meta name="keywords" content="grocery, online grocery shopping, cheap, low prices, delivery, pickup, Lowa">
        <link rel="icon" href="https://i.postimg.cc/L87TFDYM/lowa-logo.png" type="image/x-icon">
        <link rel="stylesheet" href="./css/styles.css">
        <script src="https://unpkg.com/react@18/umd/react.development.js" crossorigin></script>
        <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js" crossorigin></script>
        <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
        <script type="text/babel" src="./js/signupForm.js"></script>
        <script>
            const userLoggedIn = <?= isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] ? 'true' : 'false'; ?>;
        </script>
    </head>
    <body class="signup">
        <header>
            <img src="https://i.postimg.cc/pLZmDLvc/lowa-image.png" alt="lowa logo">
            <h4>The shop for all your grocery needs</h4>
        </header>

        <nav>
            <a class="nav-link" href="..">Home</a>
            <a class="nav-link" href="login.php">Login</a>
        </nav>
        <section>
            <h2>Signup</h2>
        </section>

        <section>
            <div id="signup-root"></div>
        </section>
    </body>
    <script src="./js/script.js"></script>
</html>