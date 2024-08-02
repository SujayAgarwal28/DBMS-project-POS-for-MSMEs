<?php
// Database connection
require '../db.php';

// Fetch customer details for editing
if (isset($_GET['id'])) {
    $customer_id = intval($_GET['id']);
    $query = "SELECT * FROM Customer WHERE CustomerID = $customer_id";
    $result = $conn->query($query);
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
        header('Location: list.php');
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Customer</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
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
