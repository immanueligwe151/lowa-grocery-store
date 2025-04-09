<?php
session_start();
include(__DIR__ . '/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $orderId = $_POST['order_id'];

    $stmt = $conn->prepare("SELECT * FROM `OrderItems` WHERE order_id = ?");
    $stmt->bind_param("s", $orderId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $items = [];
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }

    echo json_encode(['success' => true, 'items' => $items]);
    exit();
}

echo json_encode(['success' => false, 'message' => 'Invalid request']);
