<?php
include('../db.php');

$employee_id = isset($_GET['employee_id']) ? (int)$_GET['employee_id'] : 0;

if ($employee_id > 0) {
    // Fetch employee details
    $employee_result = $conn->query("SELECT FirstName, LastName FROM Employee WHERE EmployeeID = $employee_id");
    $employee = $employee_result->fetch_assoc();

    // Fetch employee sales history
    $sales_query = "
        SELECT o.OrderID, o.OrderDate, oi.ProductID, p.ProductName, oi.Quantity, oi.Price, (oi.Quantity * oi.Price) AS Total
        FROM `Order` o
        JOIN OrderItem oi ON o.OrderID = oi.OrderID
        JOIN Product p ON oi.ProductID = p.ProductID
        WHERE o.EmployeeID = $employee_id
        ORDER BY o.OrderDate DESC
    ";
    $sales_result = $conn->query($sales_query);

    // Calculate total earnings
    $total_earnings_query = "
        SELECT SUM(oi.Quantity * oi.Price) AS TotalEarnings
        FROM `Order` o
        JOIN OrderItem oi ON o.OrderID = oi.OrderID
        WHERE o.EmployeeID = $employee_id
    ";
    $total_earnings_result = $conn->query($total_earnings_query);
    $total_earnings = $total_earnings_result->fetch_assoc()['TotalEarnings'];
} else {
    die("Invalid Employee ID.");
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
    <title>Employee Sales History</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Sales History for <?php echo $employee['FirstName'] . ' ' . $employee['LastName']; ?></h1>
        <a href="../index.php" class="home-button">Home</a>
    </header>
    <main>
        <?php if ($sales_result->num_rows > 0): ?>
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
                    <?php while ($row = $sales_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['OrderID']; ?></td>
                            <td><?php echo $row['OrderDate']; ?></td>
                            <td><?php echo $row['ProductID']; ?></td>
                            <td><?php echo $row['ProductName']; ?></td>
                            <td><?php echo $row['Quantity']; ?></td>
                            <td><?php echo '₹' . number_format($row['Price'], 2); ?></td>
                            <td><?php echo '₹' . number_format($row['Total'], 2); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <div class="total-earnings">
                <strong>Total Earnings: </strong> <?php echo '₹' . number_format($total_earnings, 2); ?>
            </div>
        <?php else: ?>
            <p>No sales history found for this employee.</p>
        <?php endif; ?>
    </main>
</body>
</html>
