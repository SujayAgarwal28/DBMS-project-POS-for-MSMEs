<?php
include('../db.php');

// Fetch store names for the drop-down menu
$sql_stores = "SELECT StoreID, StoreName FROM Store";
$result_stores = $conn->query($sql_stores);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
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
        form label {
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
        }
        form input, form select {
            padding: 10px;
            margin-bottom: 20px;
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
            form input, form select, form button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Add Employee</h1>
        <a href="../index.php" class="home-button">Home</a>
    </header>
    <main>
        <form action="process_add.php" method="POST">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="position">Position:</label>
            <input type="text" id="position" name="position" required>

            <label for="hire_date">Hire Date:</label>
            <input type="date" id="hire_date" name="hire_date" required>

            <label for="store">Store Name:</label>
            <select id="store" name="store_id" required>
                <?php while ($row = $result_stores->fetch_assoc()): ?>
                    <option value="<?php echo $row['StoreID']; ?>">
                        <?php echo $row['StoreName']; ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <button type="submit">Add Employee</button>
        </form>
    </main>
</body>
</html>
