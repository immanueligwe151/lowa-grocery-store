<?php
header('Content-Type: application/json');
include('../backend/connection.php');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method Not Allowed. Please use GET.'
    ]);
    exit;
}

if (!isset($_GET['order_id']) || empty($_GET['order_id'])) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'No order number entered'
    ]);
    exit;
}

$orderId = $_GET['order_id'];

$stmt = $conn->prepare("SELECT item_name, item_quantity, subtotal FROM OrderItems WHERE order_id = ?");
$stmt->bind_param("s", $orderId);
$stmt->execute();
$result = $stmt->get_result();

$orderItems = [];

while ($row = $result->fetch_assoc()) {
    $orderItems[] = $row;
}

if (count($orderItems) === 0) {
    echo json_encode([
        'success' => false,
        'message' => 'No items found for this order ID.'
    ]);
} else {
    echo json_encode([
        'success' => true,
        'order_id' => $orderId,
        'items' => $orderItems
    ]);
}

$conn->close();
?>
