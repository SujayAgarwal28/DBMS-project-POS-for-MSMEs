<?php
// Database connection
require 'db.php';

// Sales Summary
$total_sales = 0;
$num_orders = 0;
$top_selling_product = 'None';

// Fetch total sales
$sales_query = "SELECT SUM(oi.Quantity * oi.Price) AS TotalSales FROM OrderItem oi JOIN `Order` o ON oi.OrderID = o.OrderID";
$sales_result = $conn->query($sales_query);
if ($sales_result) {
    $row = $sales_result->fetch_assoc();
    $total_sales = $row['TotalSales'] ? $row['TotalSales'] : 0;
}

// Fetch number of orders
$orders_query = "SELECT COUNT(*) AS NumOrders FROM `Order`";
$orders_result = $conn->query($orders_query);
if ($orders_result) {
    $row = $orders_result->fetch_assoc();
    $num_orders = $row['NumOrders'];
}

// Fetch top-selling product
$top_product_query = "SELECT p.ProductName, SUM(oi.Quantity) AS TotalQuantity FROM OrderItem oi JOIN Product p ON oi.ProductID = p.ProductID GROUP BY p.ProductID ORDER BY TotalQuantity DESC LIMIT 1";
$top_product_result = $conn->query($top_product_query);
if ($top_product_result && $top_product_result->num_rows > 0) {
    $row = $top_product_result->fetch_assoc();
    $top_selling_product = $row['ProductName'];
}

// Stock Alerts
$low_stock_product = 'None';

// Fetch low stock products (e.g., stock below 5)
$stock_query = "SELECT ProductName FROM Product WHERE StockQuantity < 5";
$stock_result = $conn->query($stock_query);
if ($stock_result && $stock_result->num_rows > 0) {
    $low_stock_products = [];
    while ($row = $stock_result->fetch_assoc()) {
        $low_stock_products[] = $row['ProductName'];
    }
    $low_stock_product = implode(', ', $low_stock_products);
}

// Recent Activity
$recent_activity = 'No recent activity';

// Fetch recent activities (e.g., last 5 orders)
$activity_query = "SELECT o.OrderID, o.OrderDate, c.FirstName, c.LastName FROM `Order` o JOIN Customer c ON o.CustomerID = c.CustomerID ORDER BY o.OrderDate DESC LIMIT 5";
$activity_result = $conn->query($activity_query);
if ($activity_result && $activity_result->num_rows > 0) {
    $recent_activity = '<ul>';
    while ($row = $activity_result->fetch_assoc()) {
        $recent_activity .= '<li>Order ID: ' . $row['OrderID'] . ', Date: ' . $row['OrderDate'] . ', Customer: ' . $row['FirstName'] . ' ' . $row['LastName'] . '</li>';
    }
    $recent_activity .= '</ul>';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Retail Store Management</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <header>
        <h1>Retail Store Management</h1>
    </header>
    <main>
        <section id="buttons-section">
            <a href="customers/list.php" class="nav-button">Customers</a>
            <a href="employees/list.php" class="nav-button">Employees</a>
            <a href="orders/list.php" class="nav-button">Orders</a>
            <a href="products/list.php" class="nav-button">Products</a>
            <a href="categories/list.php" class="nav-button">Categories</a>
            <a href="suppliers/list.php" class="nav-button">Suppliers</a>
            <a href="stores/list.php" class="nav-button">Stores</a>
            <a class="nav-button" href="orders/add.php">Create Order</a>
        </section>

        <section class="dashboard">
            <div class="dashboard-card summary-box">
                <h2>Sales Summary</h2>
                <table>
                    <tr>
                        <th>Total Sales:</th>
                        <td><?php echo $total_sales ? '₹' . number_format($total_sales, 2) : '₹0.00'; ?></td>
                    </tr>
                    <tr>
                        <th>Number of Orders:</th>
                        <td><?php echo number_format($num_orders); ?></td>
                    </tr>
                    <tr>
                        <th>Top-Selling Product:</th>
                        <td><?php echo $top_selling_product; ?></td>
                    </tr>
                </table>
            </div>

            <div class="dashboard-card summary-box">
                <h2>Stock Alerts</h2>
                <p>Low Stock Products: <?php echo $low_stock_product; ?></p>
            </div>

            <div class="dashboard-card summary-box">
                <h2>Recent Activity</h2>
                <?php echo $recent_activity; ?>
            </div>
        </section>
    </main>
</body>
</html>
