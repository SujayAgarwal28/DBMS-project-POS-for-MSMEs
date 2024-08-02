<?php
// Database connection
require '../db.php';

// Fetch customers from the database
$query = "SELECT * FROM Customer";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer List</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Customer List</h1>
        <a class="home-button" href="../index.php">Home</a>
    </header>
    <main>
        <section id="customer-list">
            <h2>All Customers</h2>
            <table>
                <thead>
                    <tr>
                        <th>Customer ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['CustomerID']; ?></td>
                                <td><?php echo $row['FirstName']; ?></td>
                                <td><?php echo $row['LastName']; ?></td>
                                <td><?php echo $row['Email']; ?></td>
                                <td><?php echo $row['Phone']; ?></td>
                                <td><?php echo $row['Address']; ?></td>
                                <td>
                                    <a href="edit.php?id=<?php echo $row['CustomerID']; ?>" class="action-button">Edit</a>
                                    <a href="delete.php?id=<?php echo $row['CustomerID']; ?>" class="action-button" onclick="return confirm('Are you sure you want to delete this customer?')">Delete</a>
                                    <a href="report.php?id=<?php echo $row['CustomerID']; ?>" class="action-button">Report</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No customers found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <a href="add.php" class="action-button">Add New Customer</a>
        </section>
    </main>
</body>
</html>
