<?php
include('../db.php');

// Fetch customers
$customers_result = $conn->query("SELECT CustomerID, CONCAT(FirstName, ' ', LastName) AS CustomerName FROM Customer");

// Fetch employees
$employees_result = $conn->query("SELECT EmployeeID, CONCAT(FirstName, ' ', LastName) AS EmployeeName FROM Employee");

// Fetch products
$products_result = $conn->query("SELECT ProductID, ProductName, Price, StockQuantity FROM Product");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Order</title>
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
        main {
            padding: 20px;
            max-width: 1200px;
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
            margin-right: 10px;
        }
        select, input {
            padding: 10px;
            font-size: 14px;
            margin-right: 10px;
        }
        .order-item {
            display: flex;
            align-items: center;
        }
        button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <h1>Create Order</h1>
    </header>
    <main>
        <form action="process_order.php" method="POST">
            <div>
                <label for="customer_id">Customer:</label>
                <select name="customer_id" id="customer_id" required>
                    <?php while ($row = $customers_result->fetch_assoc()) { ?>
                        <option value="<?php echo $row['CustomerID']; ?>"><?php echo htmlspecialchars($row['CustomerName']); ?></option>
                    <?php } ?>
                </select>
            </div>

            <div>
                <label for="employee_id">Employee:</label>
                <select name="employee_id" id="employee_id" required>
                    <?php while ($row = $employees_result->fetch_assoc()) { ?>
                        <option value="<?php echo $row['EmployeeID']; ?>"><?php echo htmlspecialchars($row['EmployeeName']); ?></option>
                    <?php } ?>
                </select>
            </div>

            <h2>Order Items</h2>
            <div id="order-items">
                <div class="order-item">
                    <label for="product_id[]">Product:</label>
                    <select name="product_id[]" class="product-select" required>
                        <?php while ($row = $products_result->fetch_assoc()) { ?>
                            <option value="<?php echo $row['ProductID']; ?>" data-price="<?php echo $row['Price']; ?>" data-stock="<?php echo $row['StockQuantity']; ?>"><?php echo htmlspecialchars($row['ProductName']); ?></option>
                        <?php } ?>
                    </select>

                    <label for="quantity[]">Quantity:</label>
                    <input type="number" name="quantity[]" class="quantity-input" min="1" required>

                    <label for="price[]">Price:</label>
                    <input type="text" name="price[]" class="price-input" readonly>
                </div>
            </div>

            <button type="button" id="add-item-button">Add Another Item</button>
            <button type="submit">Create Order</button>
        </form>
    </main>

    <script>
        document.getElementById('add-item-button').addEventListener('click', function() {
            const orderItems = document.getElementById('order-items');
            const newItem = document.querySelector('.order-item').cloneNode(true);
            newItem.querySelector('.quantity-input').value = '';
            newItem.querySelector('.price-input').value = '';
            orderItems.appendChild(newItem);
        });

        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('product-select')) {
                const price = e.target.selectedOptions[0].dataset.price;
                e.target.closest('.order-item').querySelector('.price-input').value = price;
            }
        });
    </script>
</body>
</html>

