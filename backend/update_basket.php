<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updatedBasket = json_decode(file_get_contents('php://input'), true);

    $_SESSION['basket'] = $updatedBasket;

    echo json_encode(['success' => true, 'newQuantity' => array_sum(array_column($_SESSION['basket'], 'quantity'))]);
}
?>
