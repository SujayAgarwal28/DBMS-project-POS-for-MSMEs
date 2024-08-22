<?php
// Database connection
require '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Gather form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Insert data into database
    $query = "INSERT INTO Customer (FirstName, LastName, Email, Phone, Address) VALUES ('$first_name', '$last_name', '$email', '$phone', '$address')";
    if ($conn->query($query) === TRUE) {
        echo "New customer added successfully!";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
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
            max-width: 1200px;
            margin: 20px auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        form {
            margin-top: 20px;
        }
        form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        form input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        form input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
    <title>Add New Customer</title>
</head>
<body>
<header>
    <h1>Add New Customer</h1>
    <a class="home-button" href="../index.php">Home</a>
</header>
<main>
    <form method="POST" action="add.php">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" required>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>

        <input type="submit" value="Add Customer">
    </form>
</main>
</body>
</html>
