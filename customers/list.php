<?php
// Database connection
require '../db.php';

// Fetch customers from the database
$query = "SELECT * FROM Customer";
$result = $conn->query($query);

if (!$result) {
    // Handle query failure
    die("Error executing query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer List</title>
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
            margin: 5px;
            transition: background 0.3s ease;
        }
        .action-button:hover {
            background-color: #0056b3;
        }
        #customer-list {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        }
        #customer-list h2 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
        }
        @media screen and (max-width: 768px) {
            table, th, td {
                display: block;
                width: 100%;
            }
            table tr {
                margin-bottom: 15px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            }
            .action-button {
                margin-top: 10px;
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Customer List</h1>
        <a class="home-button" href="../index.php">Home</a>
    </header>
    <main>
        <section id="customer-list">
        <a href="add.php" class="action-button">Add New Customer</a>
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
            
        </section>
    </main>
</body>
</html>
