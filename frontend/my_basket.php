<?php
session_start();

$basket = $_SESSION['basket'] ?? [];

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lowa</title>
        <link rel="icon" href="https://i.postimg.cc/L87TFDYM/lowa-logo.png" type="image/x-icon">
        <link rel="stylesheet" href="./css/styles.css">
        <script>
            const userLoggedIn = true;
            const basketQuantity = <?= isset($_SESSION['basket']) ? array_sum(array_column($_SESSION['basket'], 'quantity')) : 0 ?>;
            let basket = <?= json_encode($_SESSION['basket'] ?? []) ?>;
        </script>
    </head>
    <body class="my-basket">
        <header>
            <img src="https://i.postimg.cc/pLZmDLvc/lowa-image.png" alt="lowa logo">
            <h4>The shop for all your grocery needs</h4>
        </header>

        <nav>
            <a class="nav-link" href="..">Home</a>
            <a class="nav-link my-basket-a" href="./frontend/my_basket.php">My Basket</a>
            <a class="nav-link">My Account</a>
            <a class="nav-link">My Orders</a>
            <a class="nav-link" href="./frontend/logout.php">Log out</a>
        </nav>

        <section>
            <h2>My Basket</h2>
        </section>

        <section>
            <div id="basket-div">

            </div>

            <div id="total-div">

            </div>            
        </section>

        <div id="dialog">
            <div id="dialog-box">

            </div>
        </div>
    </body>
    <script src="./js/script.js"></script>
</html>
<?php var_dump($_SESSION)?>