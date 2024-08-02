<?php
include('../db.php');

$order_id = $_GET['id'];

// Fetch order details
$sql = "
    SELECT o.OrderID, o.OrderDate, c.FirstName AS CustomerFirstName, c.LastName AS CustomerLastName, e.FirstName AS EmployeeFirstName, e.LastName AS EmployeeLastName,
           p.ProductName, oi.Quantity, oi.Price, (oi.Quantity * oi.Price) AS TotalPrice
    FROM `Order` o
    JOIN Customer c ON o.CustomerID = c.CustomerID
    JOIN Employee e ON o.EmployeeID = e.EmployeeID
    JOIN OrderItem oi ON o.OrderID = oi.OrderID
    JOIN Product p ON oi.ProductID = p.ProductID
    WHERE o.OrderID = $order_id
";
$result = $conn->query($sql);

$conn->close();
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
    <title>Order Report</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Order Report</h1>
        <a href="list.php" class="home-button">Back to Orders</a>
    </header>
    <main>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Customer Name</th>
                        <th>Employee Name</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['OrderID']; ?></td>
                            <td><?php echo $row['OrderDate']; ?></td>
                            <td><?php echo $row['CustomerFirstName'] . ' ' . $row['CustomerLastName']; ?></td>
                            <td><?php echo $row['EmployeeFirstName'] . ' ' . $row['EmployeeLastName']; ?></td>
                            <td><?php echo $row['ProductName']; ?></td>
                            <td><?php echo $row['Quantity']; ?></td>
                            <td><?php echo '₹' . number_format($row['Price'], 2); ?></td>
                            <td><?php echo '₹' . number_format($row['TotalPrice'], 2); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No order details found.</p>
        <?php endif; ?>
    </main>
</body>
</html>
