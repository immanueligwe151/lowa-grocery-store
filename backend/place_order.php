<?php
session_start();
include(__DIR__ . '/connection.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderId = generateOrderNumber();
    $customerId = $_SESSION['customer_id'];
    $orderDate = date('Y-m-d');
    $orderTime = date('H:i:s');
    $totalPrice = isset($_POST['total-price']) ? (float)$_POST['total-price'] : 0.0;
    $orderType = isset($_POST['order-type']) && $_POST['order-type'] === 'pickup';
    $deliveryAddress = isset($_POST['del-address']) ? $_POST['del-address'] : '';
    $deliveryPostcode = isset($_POST['del-postcode']) ? $_POST['del-postcode'] : '';

    $stmt = $conn->prepare("INSERT INTO `Orders` (order_id, customer_id, date_of_order, time_of_order, total_price, pickup, delivery_address, postcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssdiss", $orderId, $customerId, $orderDate, $orderTime, $totalPrice, $orderType, $deliveryAddress, $deliveryPostcode);
    $complete = false;

    if ($stmt->execute()) {
        foreach ($_SESSION['basket'] as &$basketItem){
            $stmt2 = $conn->prepare("INSERT INTO `OrderItems` (order_id, item_name, item_quantity, subtotal) VALUES (?, ?, ?, ?)");
            $subtotal = $basketItem['quantity'] * $basketItem['price'];
            $stmt2->bind_param("ssid", $orderId, $basketItem['name'], $basketItem['quantity'], $subtotal);

            if (!$stmt2->execute()) {
                $complete = false;
                break;
            }

            $stmt2->close();
        }
        unset($_SESSION['basket']);
        $_SESSION['order_success'] = 'Order placed successfully! Your order number is ' . $orderId . '.';
        header('Location: ../index.php');
        exit();

    } else {
        echo json_encode(['success' => false, 'message' => 'There was an error. Please try again.']);
    }

    $stmt->close();
}

function generateOrderNumber(){
    $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $digits = '0123456789';

    return 'L-' . $letters[random_int(0, 25)] . $digits[random_int(0, 9)] . $letters[random_int(0, 25)] . $letters[random_int(0, 25)] . $digits[random_int(0, 9)];
}
?>