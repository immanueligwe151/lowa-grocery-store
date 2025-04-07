<?php
session_start();
include(__DIR__ . '/connection.php');

header('Content-Type: application/json');

if ($_SERVER('REQUEST_METHOD') === 'POST') {
    $orderId = generateOrderNumber();
    $customerId = $_SESSION('customer_id');
    $orderDate = date('d-m-Y');
    $orderTime = date('H:i:s A');
    $totalPrice = array_sum(array_column($_SESSION['basket'], 'quantity'));
}

/*
CREATE TABLE `Orders` (
	order_id VARCHAR(8) PRIMARY KEY,
    customer_id VARCHAR(8) NOT NULL,
	date_of_order DATE NOT NULL,
	time_of_order TIME NOT NULL,
	total_price FLOAT NOT NULL,
	pickup BOOLEAN,
	delivery_address VARCHAR(50),
	postcode VARCHAR(10),
    FOREIGN KEY (customer_id) REFERENCES `Customers`(customer_id)
);

CREATE TABLE `OrderItems` (
	item_id int PRIMARY KEY AUTO_INCREMENT,
    order_id VARCHAR(8) NOT NULL,
	item_name VARCHAR(20) NOT NULL,
    item_quantity INT NOT NULL,
    subtotal FLOAT NOT NULL,
    FOREIGN KEY (order_id) REFERENCES `Orders`(order_id),
    FOREIGN KEY (item_name) REFERENCES `CategoryItems`(item_name)
);
*/

function generateOrderNumber(){

}
?>