<?php
require '../db.php'; // Adjust the path as necessary

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = intval($_POST['product_id']);
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock_quantity = $_POST['stock_quantity'];
    $category_id = $_POST['category_id'];
    
    // Update the product
    $update_query = "UPDATE Product SET ProductName = ?, Price = ?, StockQuantity = ?, CategoryID = ? WHERE ProductID = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("sdiii", $name, $price, $stock_quantity, $category_id, $product_id);
    
    if ($update_stmt->execute()) {
        header('Location: list.php'); // Redirect to the list page after successful update
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    die('Invalid request method');
}
