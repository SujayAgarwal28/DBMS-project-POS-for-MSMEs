<?php
include('../db.php');

// Fetch orders with customer names, employee names, and total order values
$sql = "
    SELECT o.OrderID, o.OrderDate, c.FirstName AS CustomerFirstName, c.LastName AS CustomerLastName, e.FirstName AS EmployeeFirstName, e.LastName AS EmployeeLastName,
           SUM(oi.Quantity * oi.Price) AS TotalOrderValue
    FROM `Order` o
    JOIN Customer c ON o.CustomerID = c.CustomerID
    JOIN Employee e ON o.EmployeeID = e.EmployeeID
    JOIN OrderItem oi ON o.OrderID = oi.OrderID
    GROUP BY o.OrderID
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
    <title>Orders List</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Orders List</h1>
        <a href="../index.php" class="home-button">Home</a>
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
                        <th>Total Order Value</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['OrderID']; ?></td>
                            <td><?php echo $row['OrderDate']; ?></td>
                            <td><?php echo $row['CustomerFirstName'] . ' ' . $row['CustomerLastName']; ?></td>
                            <td><?php echo $row['EmployeeFirstName'] . ' ' . $row['EmployeeLastName']; ?></td>
                            <td><?php echo '₹' . number_format($row['TotalOrderValue'], 2); ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['OrderID']; ?>">Edit</a>
                                <a href="delete.php?id=<?php echo $row['OrderID']; ?>">Delete</a>
                                <a href="report.php?id=<?php echo $row['OrderID']; ?>">Report</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No orders found.</p>
        <?php endif; ?>
    </main>
</body>
</html>
