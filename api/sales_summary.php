<?php
header('Content-Type: application/json');
require '../db.php'; // Adjust the path as needed

$sql = "SELECT SUM(Price * Quantity) AS totalSales, COUNT(DISTINCT OrderID) AS numOrders 
        FROM OrderItem
        JOIN `Order` ON OrderItem.OrderID = `Order`.OrderID";
$result = $conn->query($sql);
$data = $result->fetch_assoc();
$data['topSellingProduct'] = ''; // Populate this as needed

echo json_encode($data);
?>
