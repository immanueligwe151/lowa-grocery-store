<?php
session_start();

include('./backend/connection.php');

$sql = "SELECT category_name FROM `Category`";
$result = $conn->query($sql);
$categories = [];

while ($row = $result->fetch_assoc()) {
    $categories[] = $row;
}

$loggedIn = isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'];

if (isset($_SESSION['order_success'])) {
    echo "<script>alert('" . addslashes($_SESSION['order_success']) . "');</script>";
    unset($_SESSION['order_success']);
}
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
        <link rel="stylesheet" href="./frontend/css/styles.css">
        <script>
            const userLoggedIn = <?= isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] ? 'true' : 'false'; ?>;
            const basketQuantity = <?= isset($_SESSION['basket']) ? array_sum(array_column($_SESSION['basket'], 'quantity')) : 0 ?>;
        </script>
    </head>
    <body class="home">
        <header>
            <img src="https://i.postimg.cc/pLZmDLvc/lowa-image.png" alt="lowa logo">
            <h4>The shop for all your grocery needs</h4>
        </header>

        <nav>
            <a class="nav-link selected">Home</a>
            <?php if ($loggedIn): ?>
                <a class="nav-link my-basket-a" href="./frontend/my_basket.php">My Basket</a>
                <a class="nav-link" href="./frontend/my_account.php">My Account</a>
                <a class="nav-link" href="./frontend/my_orders.php">My Orders</a>
                <a class="nav-link" href="./frontend/logout.php">Log out</a>
            <?php else: ?>
                <a class="nav-link" href="./frontend/login.php">Login</a>
            <?php endif; ?>
        </nav>

        <section>
            <h2>Please select a category from below</h2>
        </section>

        <section>
            <div id="dropdown-div">
                <select id="dropdown-menu">
                    <option value="" disabled selected>No category selected</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= htmlspecialchars($category['category_name']) ?>">
                            <?= htmlspecialchars($category['category_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div id="item-div">

            </div>
            
        </section>
    </body>
    <script src="./frontend/js/script.js"></script>
</html>