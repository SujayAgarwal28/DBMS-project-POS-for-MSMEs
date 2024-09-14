<?php
// Database connection
require '../db.php';

// Handle customer deletion
if (isset($_GET['id'])) {
    $customer_id = intval($_GET['id']);
    
    // Delete query
    $delete_query = $conn->prepare("DELETE FROM Customer WHERE CustomerID = ?");
    $delete_query->bind_param("i", $customer_id);
    
    if ($delete_query->execute()) {
        // Redirect to customer list after successful deletion
        header('Location: list.php');
        exit;
    } else {
        // Output error message
        echo "Error deleting record: " . $delete_query->error;
    }

    // Close the prepared statement
    $delete_query->close();
}

// Close connection
$conn->close();
?>
