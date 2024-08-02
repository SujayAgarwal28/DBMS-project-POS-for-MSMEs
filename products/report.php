<?php
include('../db.php');

if (isset($_GET['id'])) {
    $ProductID = $_GET['id'];
    $sql = "SELECT * FROM Product WHERE ProductID='$ProductID'";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Report</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Product Report</h1>
    </header>
    <main>
        <a class="nav-button" href="list.php">Back to List</a>
        <a class="nav-button" href="../index.php">Home</a>
        <h2>Product Details</h2>
        <table>
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock Quantity</th>
                    <th>Category ID</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($result) && $row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['ProductID']); ?></td>
                        <td><?php echo htmlspecialchars($row['ProductName']); ?></td>
                        <td><?php echo htmlspecialchars($row['Description']); ?></td>
                        <td><?php echo htmlspecialchars($row['Price']); ?></td>
                        <td><?php echo htmlspecialchars($row['StockQuantity']); ?></td>
                        <td><?php echo htmlspecialchars($row['CategoryID']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</body>
</html>

<?php $conn->close(); ?>
