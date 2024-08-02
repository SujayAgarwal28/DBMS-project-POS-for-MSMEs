<?php
header('Content-Type: application/json');
require '../db.php';

$sql = "SELECT ProductName AS lowStockProduct 
        FROM Product
        WHERE StockQuantity < 10"; // Adjust as needed
$result = $conn->query($sql);
$data = $result->fetch_assoc();

echo json_encode($data);
?>
