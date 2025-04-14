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
        <meta name="description" content="Lowa, an online grocery store for lower prices and higher savings.">
        <meta name="keywords" content="grocery, online grocery shopping, cheap, low prices, delivery, pickup, Lowa">
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
            <a class="nav-link my-basket-a selected">My Basket</a>
            <a class="nav-link" href="my_account.php">My Account</a>
            <a class="nav-link" href="my_orders.php">My Orders</a>
            <a class="nav-link" href="logout.php">Log out</a>
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
                <span class="close-btn" onclick="closeDialog();">&times;</span>
                <form method="POST" action="../backend/place_order.php">
                    <h2 style="text-align: left;">Place order</h2>
                    <div class="form-fields">
                        <fieldset id="type-order">
                            <legend>What type of order is this?</legend>
                            <input type="radio" value="pickup" name="order-type" id="pickup" required>
                            <label for="pickup">Pickup</label>
                            <br>
                            <input type="radio" value="delivery" name="order-type" id="delivery" required>
                            <label for="delivery">Delivery</label>
                        </fieldset>
                    </div>
                    <div class="form-fields" id="delivery-details">
                        <label for="del-address">Enter your first line of address</label>
                        <input type="text" id="del-address" name="del-address">
                        <br>
                        <br>
                        <label for="del-postcode">Enter your postcode</label>
                        <input type="text" id="del-postcode" name="del-postcode">
                    </div>

                    <input type="hidden" name="total-price" id="total-price" value="">

                    <input type="submit" class="form-submit" value="Place Order">
                </form>

            </div>
        </div>
    </body>
    <script src="./js/script.js"></script>
</html>