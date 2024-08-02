<?php
// Database connection
require '../db.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    
    // Insert data into the database
    $query = "INSERT INTO Customer (FirstName, LastName, Phone, Email, Address) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $firstName, $lastName, $phone, $email, $address);
    
    if ($stmt->execute()) {
        echo "<p>Customer added successfully.</p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }
    
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Customer</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Add Customer</h1>
        <a href="../index.php" class="home-button">Home</a>
    </header>
    <main>
        <form method="post" action="">
            <div>
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>
            <div>
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>
            <div>
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone">
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
            </div>
            <div>
                <label for="address">Address:</label>
                <textarea id="address" name="address"></textarea>
            </div>
            <div>
                <button type="submit">Add Customer</button>
            </div>
        </form>
    </main>
</body>
</html>
