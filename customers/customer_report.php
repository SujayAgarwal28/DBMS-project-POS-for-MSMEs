<?php
include('../db.php');

$customer_id = isset($_GET['customer_id']) ? (int)$_GET['customer_id'] : 0;

if ($customer_id > 0) {
    // Fetch customer details
    $customer_result = $conn->query("SELECT FirstName, LastName FROM Customer WHERE CustomerID = $customer_id");
    $customer = $customer_result->fetch_assoc();

    // Fetch customer purchase history
    $orders_query = "
        SELECT o.OrderID, o.OrderDate, oi.ProductID, p.ProductName, oi.Quantity, oi.Price, (oi.Quantity * oi.Price) AS Total
        FROM `Order` o
        JOIN OrderItem oi ON o.OrderID = oi.OrderID
        JOIN Product p ON oi.ProductID = p.ProductID
        WHERE o.CustomerID = $customer_id
        ORDER BY o.OrderDate DESC
    ";
    $orders_result = $conn->query($orders_query);

    // Calculate total amount spent
    $total_spent_query = "
        SELECT SUM(oi.Quantity * oi.Price) AS TotalSpent
        FROM `Order` o
        JOIN OrderItem oi ON o.OrderID = oi.OrderID
        WHERE o.CustomerID = $customer_id
    ";
    $total_spent_result = $conn->query($total_spent_query);
    $total_spent = $total_spent_result->fetch_assoc()['TotalSpent'];
} else {
    die("Invalid Customer ID.");
}
?>

<!DOCTYPE html>
<html>
<style>table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}</style>
<head>
    <title>Customer Purchase History</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Purchase History for <?php echo $customer['FirstName'] . ' ' . $customer['LastName']; ?></h1>
        <a href="../index.php" class="home-button">Home</a>
    </header>
    <main>
        <?php if ($orders_result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $orders_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['OrderID']; ?></td>
                            <td><?php echo $row['OrderDate']; ?></td>
                            <td><?php echo $row['ProductID']; ?></td>
                            <td><?php echo $row['ProductName']; ?></td>
                            <td><?php echo $row['Quantity']; ?></td>
                            <td><?php echo '$' . number_format($row['Price'], 2); ?></td>
                            <td><?php echo '$' . number_format($row['Total'], 2); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <div class="total-spent">
                <strong>Total Amount Spent: </strong> <?php echo '₹' . number_format($total_spent, 2); ?>
            </div>
        <?php else: ?>
            <p>No purchase history found for this customer.</p>
        <?php endif; ?>
    </main>
</body>
</html>


