<?php
include('../db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $SupplierID = $_POST['SupplierID'];
    $SupplierName = $_POST['SupplierName'];
    $ContactName = $_POST['ContactName'];
    $Phone = $_POST['Phone'];
    $Address = $_POST['Address'];
    
    

    $sql = "INSERT INTO Supplier (SupplierID, SupplierName, ContactName, Phone,Address )
            VALUES ('$SupplierID', '$SupplierName', '$ContactName', '$Phone','$Address' )";

    if ($conn->query($sql) === TRUE) {
        echo "New supplier added successfully. <a href='list.php'>Back to List</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Supplier</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Add Supplier</h1>
    </header>
    <main>
        <a class="nav-button" href="list.php">Back to List</a>
        <a class="nav-button" href="../index.php">Home</a>
        <form method="post" action="" class="form-container">
            <label for="SupplierID">Supplier ID:</label>
            <input type="text" id="SupplierID" name="SupplierID" required>
            <label for="SupplierName">Supplier Name:</label>
            <input type="text" id="SupplierName" name="SupplierName" required>
            <label for="ContactName">Contact Name:</label>
            <input type="text" id="ContactName" name="ContactName" required>
            <label for="Phone">Phone:</label>
            <input type="text" id="Phone" name="Phone" required>
            <label for="Address">Address:</label>
            <input type="text" id="Address" name="Address" required>
            
            
            <input type="submit" value="Add Supplier">
        </form>
    </main>
</body>
</html>

<?php $conn->close(); ?>
