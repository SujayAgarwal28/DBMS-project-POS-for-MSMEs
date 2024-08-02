<?php
include('../db.php');

$customer_id = $_POST['customer_id'];
$employee_id = $_POST['employee_id'];
$order_date = date('Y-m-d');

// Create order
$order_sql = "INSERT INTO `Order` (OrderDate, CustomerID, EmployeeID) VALUES ('$order_date', '$customer_id', '$employee_id')";
$conn->query($order_sql);
$order_id = $conn->insert_id;

// Add order items
$product_ids = $_POST['product_id'];
$quantities = $_POST['quantity'];
$prices = $_POST['price'];

for ($i = 0; $i < count($product_ids); $i++) {
    $product_id = $product_ids[$i];
    $quantity = $quantities[$i];
    $price = $prices[$i];

    // Add order item
    $order_item_sql = "INSERT INTO OrderItem (OrderID, ProductID, Quantity, Price) VALUES ('$order_id', '$product_id', '$quantity', '$price')";
    $conn->query($order_item_sql);

    // Update product stock quantity
    $update_stock_sql = "UPDATE Product SET StockQuantity = StockQuantity - '$quantity' WHERE ProductID = '$product_id'";
    $conn->query($update_stock_sql);
}

$conn->close();

header('Location: list.php');
?>
