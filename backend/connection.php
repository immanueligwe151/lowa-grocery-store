<?php
$hostname = "katara.scam.keele.ac.uk";
$username = "x6g22";
$password = "x6g22x6g22";
$db = "x6g22";

$conn = new mysqli($hostname, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>