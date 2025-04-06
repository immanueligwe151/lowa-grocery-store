<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $items = json_decode(file_get_contents('php://input'), true);
    $itemName = $items['name'];

    if (!isset($_SESSION['basket'])) {
        $_SESSION['basket'] = [];
    }

    $found = false;
    foreach ($_SESSION['basket'] as &$basketItem) {
        if ($basketItem['name'] === $items['name']) {
            $basketItem['quantity'] += 1;  // Increase quantity if item already in the basket
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['basket'][] = [
            'name' => $items['name'],
            'imageLink' => $items['imageLink']
            'price' => $items['price'],
            'quantity' => 1,
        ];
    }

    $itemCount = array_sum(array_column($_SESSION['basket'], 'quantity'));
    echo json_encode(['success' => true, 'itemCount' => $itemCount]);

}

?>