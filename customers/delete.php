<?php
// Database connection
require '../db.php';

// Handle customer deletion
if (isset($_GET['id'])) {
    $customer_id = intval($_GET['id']);
    
    // Delete query
    $delete_query = "DELETE FROM Customer WHERE CustomerID = $customer_id";
    
    if ($conn->query($delete_query)) {
        // Redirect to customer list after successful deletion
        header('Location: list.php');
        exit;
    } else {
        // Output error message
        echo "Error deleting record: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>
