<?php
// Database connection
require '../db.php';

// Handle customer deletion
if (isset($_GET['id'])) {
    $customer_id = intval($_GET['id']);
    $delete_query = "DELETE FROM Customer WHERE CustomerID = $customer_id";
    if ($conn->query($delete_query)) {
        header('Location: list.php');
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
