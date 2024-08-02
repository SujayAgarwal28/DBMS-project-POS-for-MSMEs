<?php
require '../db.php'; // Adjust the path as necessary

if (isset($_GET['id'])) {
    $order_id = intval($_GET['id']);

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Delete related orderitem records
        $delete_items_query = "DELETE FROM orderitem WHERE OrderID = ?";
        $stmt = $conn->prepare($delete_items_query);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        
        // Delete the order
        $delete_order_query = "DELETE FROM `order` WHERE OrderID = ?";
        $stmt = $conn->prepare($delete_order_query);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        
        // Commit the transaction
        $conn->commit();
        header('Location: list.php'); // Redirect to the list page after successful deletion
    } catch (Exception $e) {
        // Rollback the transaction if something fails
        $conn->rollback();
        echo "Error deleting record: " . $e->getMessage();
    }
} else {
    die('No order ID provided');
}
