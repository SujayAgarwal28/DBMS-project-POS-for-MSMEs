<?php
header('Content-Type: application/json');
require '../db.php';

$sql = "SELECT CONCAT('Order ID ', OrderID, ' placed on ', OrderDate) AS activity
        FROM `Order`
        ORDER BY OrderDate DESC
        LIMIT 5"; // Adjust as needed
$result = $conn->query($sql);

$activities = [];
while ($row = $result->fetch_assoc()) {
    $activities[] = $row['activity'];
}

echo json_encode(['activities' => $activities]);
?>
