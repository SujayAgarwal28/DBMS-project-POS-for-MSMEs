<?php
// Database connection
require '../db.php';

// Check if customer ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid customer ID");
}

$customer_id = intval($_GET['id']);

// Fetch customer details
$customer_query = "SELECT * FROM Customer WHERE CustomerID = $customer_id";
$customer_result = $conn->query($customer_query);

if ($customer_result->num_rows === 0) {
    die("Customer not found");
}

$customer = $customer_result->fetch_assoc();

// Fetch purchase history and calculate total spending
$purchase_query = "
    SELECT o.OrderID, o.OrderDate, oi.ProductID, p.ProductName, oi.Quantity, oi.Price, (oi.Quantity * oi.Price) AS TotalPrice
    FROM `Order` o
    JOIN OrderItem oi ON o.OrderID = oi.OrderID
    JOIN Product p ON oi.ProductID = p.ProductID
    WHERE o.CustomerID = $customer_id
    ORDER BY o.OrderDate DESC
";

$purchase_result = $conn->query($purchase_query);

$total_spending = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Report</title>
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
        header .home-button, .print-button {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            transition: background 0.3s ease;
        }
        header .home-button:hover, .print-button:hover {
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
        #customer-report h2 {
            font-size: 22px;
            margin-bottom: 15px;
            color: #333;
        }
        p {
            font-size: 16px;
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
        .print-button {
            background-color: #007BFF;
            margin-top: 20px;
            cursor: pointer;
        }
        .total-spending {
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
            }
        }
    </style>
    <script>
        function printReport() {
            window.print();
        }
    </script>
</head>
<body>
    <header>
        <h1>Report for <?php echo htmlspecialchars($customer['FirstName'] . ' ' . $customer['LastName']); ?></h1>
        <a class="home-button" href="../index.php">Home</a>
        <button class="print-button" onclick="printReport()">Print Report</button>
    </header>
    <main>
        <section id="customer-report">
            <h2>Customer Details</h2>
            <p><strong>Customer ID:</strong> <?php echo htmlspecialchars($customer['CustomerID']); ?></p>
            <p><strong>First Name:</strong> <?php echo htmlspecialchars($customer['FirstName']); ?></p>
            <p><strong>Last Name:</strong> <?php echo htmlspecialchars($customer['LastName']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($customer['Email']); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($customer['Phone']); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($customer['Address']); ?></p>

            <h2>Purchase History</h2>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($purchase_result->num_rows > 0): ?>
                        <?php while ($row = $purchase_result->fetch_assoc()): ?>
                            <?php $total_spending += $row['TotalPrice']; ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['OrderID']); ?></td>
                                <td><?php echo htmlspecialchars($row['OrderDate']); ?></td>
                                <td><?php echo htmlspecialchars($row['ProductID']); ?></td>
                                <td><?php echo htmlspecialchars($row['ProductName']); ?></td>
                                <td><?php echo htmlspecialchars($row['Quantity']); ?></td>
                                <td>₹<?php echo htmlspecialchars(number_format($row['Price'], 2)); ?></td>
                                <td>₹<?php echo htmlspecialchars(number_format($row['TotalPrice'], 2)); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No purchase history found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <h2>Total Spending</h2>
            <p class="total-spending">Total Spending: ₹<?php echo number_format($total_spending, 2); ?></p>
        </section>
    </main>
</body>
</html>
