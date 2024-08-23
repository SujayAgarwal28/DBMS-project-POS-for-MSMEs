<?php
include('../db.php');

// Fetch products with their category names
$sql = "
    SELECT p.ProductID, p.ProductName, p.Description, p.Price, p.StockQuantity, c.CategoryName 
    FROM Product p
    JOIN Category c ON p.CategoryID = c.CategoryID
";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products List</title>
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
        .nav-button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 5px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            transition: background 0.3s ease;
        }
        .nav-button:hover {
            background-color: #0056b3;
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
        <h1>Products List</h1>
        <a href="../index.php" class="home-button">Home</a>
    </header>
    <main>
        <a class="nav-button" href="add.php">Add Product</a>
        <a class="nav-button" href="../index.php">Home</a>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Stock Quantity</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['ProductID']; ?></td>
                            <td><?php echo $row['ProductName']; ?></td>
                            <td><?php echo $row['Description']; ?></td>
                            <td><?php echo '₹' . number_format($row['Price'], 2); ?></td>
                            <td><?php echo $row['StockQuantity']; ?></td>
                            <td><?php echo $row['CategoryName']; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['ProductID']; ?>" class="action-button">Edit</a>
                                <a href="delete.php?id=<?php echo $row['ProductID']; ?>" class="action-button">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>
    </main>
</body>
</html>
