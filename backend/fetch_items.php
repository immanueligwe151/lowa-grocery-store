<?php
include('./connection.php');

if (isset($_GET['category'])) {
    $category = $conn->real_escape_string($_GET['category']);

    $sql = "SELECT item_name, item_imagelink, item_price FROM `CategoryItems` WHERE category_name = '$category'";
    $result = $conn->query($sql);

    $items = [];
    while ($row = $result->fetch_assoc()) {
        $items[] = [
            "name" => $row['item_name'],
            "image" => $row['item_imagelink'],
            "price" => $row['item_price']
        ];
    }

    echo json_encode($items);
} else {
    echo json_encode(["error" => "No category selected"]);
}
?>
