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
    $row = $stock_result->fetch_assoc();
    $low_stock_product = $row['ProductName'];
}

// Recent Activity
$recent_activity = 'No recent activity';

// Fetch recent activities (e.g., last 10 orders)
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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        h1 {
            margin: 0;
        }
        main {
            padding: 20px;
        }
        .nav-button {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            background: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
        .nav-button:hover {
            background: #0056b3;
        }
        .summary-box {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin: 20px 0;
            padding: 20px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        .summary-box h2 {
            margin-top: 0;
            color: #333;
        }
        .summary-box table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }
        .summary-box table th, .summary-box table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .summary-box table th {
            background-color: #f2f2f2;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        ul li {
            background: #eee;
            margin: 5px 0;
            padding: 10px;
            border-radius: 4px;
        }
    </style>
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

        <section id="summary-section" class="summary-box">
            <h2>Sales Summary</h2>
            <table>
                <tr>
                    <th>Total Sales</th>
                    <td><?php echo $total_sales ? '$' . number_format($total_sales, 2) : '$0.00'; ?></td>
                </tr>
                <tr>
                    <th>Number of Orders</th>
                    <td><?php echo $num_orders; ?></td>
                </tr>
                <tr>
                    <th>Top-Selling Product</th>
                    <td><?php echo $top_selling_product; ?></td>
                </tr>
            </table>
        </section>

        <section id="stock-alert-section" class="summary-box">
            <h2>Stock Alerts</h2>
            <p>Low Stock Product: <?php echo $low_stock_product; ?></p>
        </section>

        <section id="activity-section" class="summary-box">
            <h2>Recent Activity</h2>
            <?php echo $recent_activity; ?>
        </section>
    </main>
</body>
</html>
