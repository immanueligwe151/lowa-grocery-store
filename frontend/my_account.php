<?php
session_start();

include('../backend/connection.php');

$basket = $_SESSION['basket'] ?? [];

$customerId = $_SESSION['customer_id'];

$stmt = $conn->prepare("SELECT * FROM `Customers` WHERE customer_id = ?");
$stmt->bind_param("s", $customerId);
$stmt->execute();
$result = $stmt->get_result();
$userDetails = $result->fetch_assoc();

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
    <body class="my-account">
        <header>
            <img src="https://i.postimg.cc/pLZmDLvc/lowa-image.png" alt="lowa logo">
            <h4>The shop for all your grocery needs</h4>
        </header>

        <nav>
            <a class="nav-link" href="..">Home</a>
            <a class="nav-link my-basket-a" href="my_basket.php">My Basket</a>
            <a class="nav-link selected">My Account</a>
            <a class="nav-link" href="my_orders.php">My Orders</a>
            <a class="nav-link" href="logout.php">Log out</a>
        </nav>

        <section>
            <h2>My Account</h2>
        </section>

        <section id="account-page">
            <div class="account-details">
                <h3>Name</h3>
                <h5><?php echo htmlspecialchars($userDetails['customer_name']); ?></h5>
            </div>

            <div class="account-details">
                <h3>Customer ID</h3>
                <h5><?php echo htmlspecialchars($userDetails['customer_id']); ?></h5>
            </div>

            <div class="account-details">
                <h3>Email</h3>
                <h5><?php echo htmlspecialchars($userDetails['customer_email']); ?></h5>
            </div>

            <div class="account-details">
                <h3>Phone Number</h3>
                <h5><?php echo htmlspecialchars($userDetails['customer_phone']); ?></h5>
            </div>
        </section>
    </body>
    <script src="./js/script.js"></script>
</html>