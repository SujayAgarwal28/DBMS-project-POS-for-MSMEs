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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Sales History</title>
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
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
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
        .total-earnings {
            font-size: 18px;
            margin-top: 20px;
            font-weight: bold;
        }
        @media screen and (max-width: 768px) {
            main {
                padding: 10px;
            }
            table th, table td {
                display: block;
                width: 100%;
            }
            table tr {
                margin-bottom: 15px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Sales History for <?php echo htmlspecialchars($employee['FirstName'] . ' ' . $employee['LastName']); ?></h1>
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
                            <td><?php echo htmlspecialchars($row['OrderID']); ?></td>
                            <td><?php echo htmlspecialchars($row['OrderDate']); ?></td>
                            <td><?php echo htmlspecialchars($row['ProductID']); ?></td>
                            <td><?php echo htmlspecialchars($row['ProductName']); ?></td>
                            <td><?php echo htmlspecialchars($row['Quantity']); ?></td>
                            <td>₹<?php echo number_format($row['Price'], 2); ?></td>
                            <td>₹<?php echo number_format($row['Total'], 2); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <div class="total-earnings">
                <strong>Total Earnings: </strong> ₹<?php echo number_format($total_earnings, 2); ?>
            </div>
        <?php else: ?>
            <p>No sales history found for this employee.</p>
        <?php endif; ?>
    </main>
</body>
</html>

<?php $conn->close(); ?>
