<?php
include('../db.php');

// Fetch categories
$category_query = "SELECT CategoryID, CategoryName FROM Category";
$category_result = $conn->query($category_query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['ProductName'];
    $description = $_POST['Description'];
    $price = $_POST['Price'];
    $stock_quantity = $_POST['StockQuantity'];
    $category_id = $_POST['CategoryID'];

    $sql = "INSERT INTO Product (ProductName, Description, Price, StockQuantity, CategoryID) VALUES ('$product_name', '$description', '$price', '$stock_quantity', '$category_id')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New product added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Add Product</h1>
        <a href="../index.php" class="home-button">Home</a>
    </header>
    <main>
        <form method="POST" action="add.php">
            <div>
                <label for="ProductName">Product Name:</label>
                <input type="text" id="ProductName" name="ProductName" required>
            </div>
            <div>
                <label for="Description">Description:</label>
                <textarea id="Description" name="Description" required></textarea>
            </div>
            <div>
                <label for="Price">Price:</label>
                <input type="number" step="0.01" id="Price" name="Price" required>
            </div>
            <div>
                <label for="StockQuantity">Stock Quantity:</label>
                <input type="number" id="StockQuantity" name="StockQuantity" required>
            </div>
            <div>
                <label for="CategoryID">Category:</label>
                <select id="CategoryID" name="CategoryID" required>
                    <?php while ($row = $category_result->fetch_assoc()): ?>
                        <option value="<?php echo $row['CategoryID']; ?>"><?php echo $row['CategoryName']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div>
                <button type="submit">Add Product</button>
            </div>
        </form>
    </main>
</body>
</html>
