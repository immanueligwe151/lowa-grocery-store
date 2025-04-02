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
        <title>Lowa</title>
        <link rel="icon" href="https://i.postimg.cc/L87TFDYM/lowa-logo.png" type="image/x-icon">
        <link rel="stylesheet" href="./frontend/css/styles.css">
    </head>
    <body>
        <header>
            <img src="https://i.postimg.cc/pLZmDLvc/lowa-image.png" alt="lowa logo">
            <h4>The shop for all your grocery needs</h4>
        </header>

        <nav>
            <a class="nav-link">Home</a>
            <?php if ($loggedIn): ?>
                <a class="nav-link">My Basket</a>
                <a class="nav-link">My Account</a>
                <a class="nav-link">My Orders</a>
            <?php else: ?>
                <a class="nav-link">Login</a>
            <?php endif; ?>
        </nav>

        <section>
            
        </section>
    </body>
    <style src="./frontend/js/script.js"></style>
</html>