<?php
// Database connection
require '../db.php';

// Fetch customer details for editing
if (isset($_GET['id'])) {
    $customer_id = intval($_GET['id']);
    $query = "SELECT * FROM Customer WHERE CustomerID = $customer_id";
    $result = $conn->query($query);

    // Check if the query was successful
    if (!$result) {
        die("Error fetching customer details: " . $conn->error);
    }

    $customer = $result->fetch_assoc();
}

// Handle form submission for updates
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $update_query = "UPDATE Customer SET FirstName = '$first_name', LastName = '$last_name', Email = '$email', Phone = '$phone', Address = '$address' WHERE CustomerID = $customer_id";
    if ($conn->query($update_query)) {
        header('Location: list.php'); // Redirect to list page after successful update
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Customer</title>
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
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        form {
            margin-top: 20px;
        }
        form div {
            margin-bottom: 15px;
        }
        form label {
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
            display: block;
        }
        form input, form textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        form textarea {
            resize: vertical;
        }
        form button {
            background-color: #007BFF;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <h1>Edit Customer</h1>
        <a class="home-button" href="../index.php">Home</a>
    </header>
    <main>
        <section id="edit-customer">
            <form method="post">
                <div>
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" value="<?php echo $customer['FirstName']; ?>" required>
                </div>
                <div>
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" value="<?php echo $customer['LastName']; ?>" required>
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $customer['Email']; ?>" required>
                </div>
                <div>
                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" name="phone" value="<?php echo $customer['Phone']; ?>" required>
                </div>
                <div>
                    <label for="address">Address:</label>
                    <textarea id="address" name="address" required><?php echo $customer['Address']; ?></textarea>
                </div>
                <button type="submit">Update Customer</button>
            </form>
        </section>
    </main>
</body>
</html>
