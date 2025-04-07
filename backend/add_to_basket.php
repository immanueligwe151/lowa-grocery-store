<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode the incoming JSON data
    $items = json_decode(file_get_contents('php://input'), true);

    // Validate the essential fields
    if (!isset($items['name'], $items['price'], $items['imageLink'])) {
        echo json_encode(['success' => false, 'error' => 'Invalid item data']);
        exit;
    }

    // Initialize basket session if not present
    if (!isset($_SESSION['basket'])) {
        $_SESSION['basket'] = [];
    }

    // Check if item already exists in basket
    $found = false;
    foreach ($_SESSION['basket'] as &$basketItem) {
        if ($basketItem['name'] === $items['name']) {
            $basketItem['quantity'] += 1;
            $found = true;
            break;
        }
    }

    // If item not found, add it
    if (!$found) {
        $_SESSION['basket'][] = [
            'name' => $items['name'],
            'imageLink' => $items['imageLink'],
            'price' => $items['price'],
            'quantity' => 1,
        ];
    }

    // Count total quantity of items in basket
    $itemCount = array_sum(array_column($_SESSION['basket'], 'quantity'));

    // Respond with success
    echo json_encode(['success' => true, 'itemCount' => $itemCount]);
}


/* session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $items = json_decode(file_get_contents('php://input'), true);
    echo $items;
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
            'imageLink' => $items['imageLink'],
            'price' => $items['price'],
            'quantity' => 1,
        ];
    }

    $itemCount = array_sum(array_column($_SESSION['basket'], 'quantity'));
    echo json_encode(['success' => true, 'itemCount' => $itemCount]);

} */

?>