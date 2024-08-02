<?php
include('../db.php');

// Fetch store names for the drop-down menu
$sql_stores = "SELECT StoreID, StoreName FROM Store";
$result_stores = $conn->query($sql_stores);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
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
