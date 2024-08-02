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
<html>
<head>
    <title>Customer Report</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Report for <?php echo htmlspecialchars($customer['FirstName'] . ' ' . $customer['LastName']); ?></h1>
        <a class="home-button" href="../index.php">Home</a>
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
                                <td><?php echo htmlspecialchars($row['Price']); ?></td>
                                <td><?php echo number_format($row['TotalPrice'], 2); ?></td>
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
            <p><strong>Total Spending:</strong> ₹<?php echo number_format($total_spending, 2); ?></p>
        </section>
    </main>
</body>
</html>
