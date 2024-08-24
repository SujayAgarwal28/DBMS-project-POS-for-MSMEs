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

    $sql = "INSERT INTO Product (ProductName, Description, Price, StockQuantity, CategoryID) 
            VALUES ('$product_name', '$description', '$price', '$stock_quantity', '$category_id')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New product added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
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
            max-width: 800px;
            margin: 20px auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        form {
            display: flex;
            flex-direction: column;
        }
        form div {
            margin-bottom: 20px;
        }
        form label {
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
        }
        form input, form textarea, form select {
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 14px;
        }
        form button {
            background-color: #007BFF;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        form button:hover {
            background-color: #0056b3;
        }
        @media screen and (max-width: 768px) {
            main {
                padding: 10px;
            }
        }
    </style>
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
