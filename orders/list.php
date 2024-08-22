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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders List</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #007BFF;
            color: white;
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        header h1 {
            margin: 0;
            font-size: 28px;
        }
        header .home-button {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            transition: background 0.3s ease;
        }
        header .home-button:hover {
            background-color: #218838;
        }
        main {
            padding: 20px;
            max-width: 1200px;
            margin: 20px auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        table th, table td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #007BFF;
            color: white;
        }
        table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        table tr:hover {
            background-color: #e9ecef;
        }
        .action-button {
            display: inline-block;
            padding: 8px 15px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            transition: background 0.3s ease;
            margin-right: 5px;
        }
        .action-button:hover {
            background-color: #0056b3;
        }
    </style>
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
                                <a href="edit.php?id=<?php echo $row['OrderID']; ?>" class="action-button">Edit</a>
                                <a href="delete.php?id=<?php echo $row['OrderID']; ?>" class="action-button">Delete</a>
                                <a href="report.php?id=<?php echo $row['OrderID']; ?>" class="action-button">Report</a>
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
