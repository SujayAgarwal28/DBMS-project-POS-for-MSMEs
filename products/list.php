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
    <title>Products List</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
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
                                <a href="edit.php?id=<?php echo $row['ProductID']; ?>">Edit</a>
                                <a href="delete.php?id=<?php echo $row['ProductID']; ?>">Delete</a>
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
