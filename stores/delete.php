<?php
require '../db.php'; // Adjust the path as necessary

if (isset($_GET['id'])) {
    $store_id = intval($_GET['id']);

    // Start a transaction
    $conn->begin_transaction();

    try {
        // Delete related employee records
        $delete_employees_query = "DELETE FROM employee WHERE StoreID = ?";
        $stmt = $conn->prepare($delete_employees_query);
        $stmt->bind_param("i", $store_id);
        $stmt->execute();
        
        // Delete the store
        $delete_store_query = "DELETE FROM store WHERE StoreID = ?";
        $stmt = $conn->prepare($delete_store_query);
        $stmt->bind_param("i", $store_id);
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
    die('No store ID provided');
}
