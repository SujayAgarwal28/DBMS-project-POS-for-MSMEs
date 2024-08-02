<?php
require '../db.php'; // Adjust the path as necessary

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Delete related records from OrderItem
        $delete_order_items_query = "DELETE FROM OrderItem WHERE ProductID = ?";
        $stmt = $conn->prepare($delete_order_items_query);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        
        // Delete the product
        $delete_product_query = "DELETE FROM Product WHERE ProductID = ?";
        $stmt = $conn->prepare($delete_product_query);
        $stmt->bind_param("i", $product_id);
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
    die('No product ID provided');
}
