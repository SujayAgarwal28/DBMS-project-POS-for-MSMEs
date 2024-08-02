<?php
include('../db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $StoreID = $_POST['StoreID'];
    $StoreName = $_POST['StoreName'];
    $Address = $_POST['Address'];
    $Phone = $_POST['Phone'];

    $sql = "INSERT INTO Store (StoreID, StoreName, Address, Phone) VALUES ('$StoreID', '$StoreName', '$Address', '$Phone')";

    if ($conn->query($sql) === TRUE) {
        echo "New store added successfully. <a href='list.php'>Back to List</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Store</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Add Store</h1>
    </header>
    <main>
        <a class="nav-button" href="list.php">Back to List</a>
        <a class="nav-button" href="../index.php">Home</a>
        <form method="post" action="" class="form-container">
            <label for="StoreID">Store ID:</label>
            <input type="text" id="StoreID" name="StoreID" required>
            <label for="StoreName">Store Name:</label>
            <input type="text" id="StoreName" name="StoreName" required>
            <label for="Address">Address:</label>
            <input type="text" id="Address" name="Address" required>
            <label for="Phone">Phone:</label>
            <input type="text" id="Phone" name="Phone" required>
            <input type="submit" value="Add Store">
        </form>
    </main>
</body>
</html>

<?php $conn->close(); ?>
