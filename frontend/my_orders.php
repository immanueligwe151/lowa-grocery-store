<?php
session_start();

include('../backend/connection.php');

$basket = $_SESSION['basket'] ?? [];

$customerId = $_SESSION['customer_id'];

$stmt = $conn->prepare("SELECT * FROM `Orders` WHERE customer_id = ?");
$stmt->bind_param("s", $customerId);
$stmt->execute();
$result = $stmt->get_result();
$orders = [];

while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
}

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
    <body class="my-orders">
        <header>
            <img src="https://i.postimg.cc/pLZmDLvc/lowa-image.png" alt="lowa logo">
            <h4>The shop for all your grocery needs</h4>
        </header>

        <nav>
            <a class="nav-link" href="..">Home</a>
            <a class="nav-link my-basket-a" href="my_basket.php">My Basket</a>
            <a class="nav-link" href="my_account.php">My Account</a>
            <a class="nav-link">My Orders</a>
            <a class="nav-link" href="./frontend/logout.php">Log out</a>
        </nav>

        <section>
            <h2>My Orders</h2>
        </section>

        <section>
            <?php foreach ($orders as $order): ?>
                <div class="order" data-order-id="<?= htmlspecialchars($order['order_id']) ?>">
                    <div class="order-header">
                        <div class="order-header-details">
                            <h3>Order <?= htmlspecialchars($order['order_id']) ?></h3>
                            <h5>Ordered on <?= htmlspecialchars($order['date_of_order']) ?></h5>
                            <h5>Total price paid: £<?= number_format($order['total_price'], 2) ?></h5>
                        </div>
                        <span class="toggle-order">&#9660;</span>
                    </div>

                    <div class="order-details" style="display: none;">
                        <p>Loading...</p>

                        
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
    </body>
    <script src="./js/script.js"></script>
</html>