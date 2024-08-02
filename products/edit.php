<?php
require '../db.php'; // Adjust the path as necessary

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    
    // Fetch existing product details
    $query = "SELECT * FROM Product WHERE ProductID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        die('Product not found');
    }
} else {
    die('No product ID provided');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock_quantity = $_POST['stock_quantity'];
    $category_id = $_POST['category_id'];
    
    // Update the product
    $update_query = "UPDATE Product SET ProductName = ?, Price = ?, StockQuantity = ?, CategoryID = ? WHERE ProductID = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("sdiii", $name, $price, $stock_quantity, $category_id, $product_id);
    
    if ($update_stmt->execute()) {
        header('Location: list.php'); // Redirect to the list page after successful update
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <h1>Edit Product</h1>
    <form method="POST" action="">
        <div>
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['ProductName']); ?>" required>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" value="<?php echo htmlspecialchars($product['Price']); ?>" required>
        </div>
        <div>
            <label for="stock_quantity">Stock Quantity:</label>
            <input type="number" id="stock_quantity" name="stock_quantity" value="<?php echo htmlspecialchars($product['StockQuantity']); ?>" required>
        </div>
        <div>
            <label for="category_id">Category:</label>
            <select id="category_id" name="category_id" required>
                <?php
                // Fetch categories for the dropdown
                $category_query = "SELECT * FROM Category";
                $category_result = $conn->query($category_query);
                while ($category = $category_result->fetch_assoc()) {
                    $selected = ($category['CategoryID'] == $product['CategoryID']) ? 'selected' : '';
                    echo "<option value=\"{$category['CategoryID']}\" $selected>{$category['CategoryName']}</option>";
                }
                ?>
            </select>
        </div>
        <div>
            <button type="submit">Update Product</button>
        </div>
    </form>
</body>
</html>
