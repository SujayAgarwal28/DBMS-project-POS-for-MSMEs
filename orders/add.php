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
<html>
<head>
    <title>Create Order</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Create Order</h1>
    </header>
    <main>
        <form action="process_order.php" method="POST">
            <label for="customer_id">Customer:</label>
            <select name="customer_id" id="customer_id" required>
                <?php while ($row = $customers_result->fetch_assoc()) { ?>
                    <option value="<?php echo $row['CustomerID']; ?>"><?php echo $row['CustomerName']; ?></option>
                <?php } ?>
            </select>

            <label for="employee_id">Employee:</label>
            <select name="employee_id" id="employee_id" required>
                <?php while ($row = $employees_result->fetch_assoc()) { ?>
                    <option value="<?php echo $row['EmployeeID']; ?>"><?php echo $row['EmployeeName']; ?></option>
                <?php } ?>
            </select>

            <h2>Order Items</h2>
            <div id="order-items">
                <div class="order-item">
                    <label for="product_id[]">Product:</label>
                    <select name="product_id[]" class="product-select" required>
                        <?php while ($row = $products_result->fetch_assoc()) { ?>
                            <option value="<?php echo $row['ProductID']; ?>" data-price="<?php echo $row['Price']; ?>" data-stock="<?php echo $row['StockQuantity']; ?>"><?php echo $row['ProductName']; ?></option>
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
