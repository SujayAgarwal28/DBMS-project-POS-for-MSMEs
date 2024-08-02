<?php
include('../db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $SupplierID = $_POST['SupplierID'];
    $SupplierName = $_POST['SupplierName'];
    $ContactName = $_POST['ContactName'];
    $Address = $_POST['Address'];
    $City = $_POST['City'];
    $PostalCode = $_POST['PostalCode'];
    $Country = $_POST['Country'];
    $Phone = $_POST['Phone'];

    $sql = "UPDATE Supplier SET SupplierName='$SupplierName', ContactName='$ContactName', Address='$Address', City='$City', PostalCode='$PostalCode', Country='$Country', Phone='$Phone'
            WHERE SupplierID='$SupplierID'";

    if ($conn->query($sql) === TRUE) {
        echo "Supplier updated successfully. <a href='list.php'>Back to List</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} elseif (isset($_GET['id'])) {
    $SupplierID = $_GET['id'];
    $sql = "SELECT * FROM Supplier WHERE SupplierID='$SupplierID'";
    $result = $conn->query($sql);
    $record = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Supplier</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Edit Supplier</h1>
    </header>
    <main>
        <a class="nav-button" href="list.php">Back to List</a>
        <a class="nav-button" href="../index.php">Home</a>
        <form method="post" action="" class="form-container">
            <input type="hidden" name="SupplierID" value="<?php echo htmlspecialchars($record['SupplierID']); ?>">
            <label for="SupplierName">Supplier Name:</label>
            <input type="text" id="SupplierName" name="SupplierName" value="<?php echo htmlspecialchars($record['SupplierName']); ?>" required>
            <label for="ContactName">Contact Name:</label>
            <input type="text" id="ContactName" name="ContactName" value="<?php echo htmlspecialchars($record['ContactName']); ?>" required>
            <label for="Address">Address:</label>
            <input type="text" id="Address" name="Address" value="<?php echo htmlspecialchars($record['Address']); ?>" required>
            <label for="City">City:</label>
            <input type="text" id="City" name="City" value="<?php echo htmlspecialchars($record['City']); ?>" required>
            <label for="PostalCode">Postal Code:</label>
            <input type="text" id="PostalCode" name="PostalCode" value="<?php echo htmlspecialchars($record['PostalCode']); ?>" required>
            <label for="Country">Country:</label>
            <input type="text" id="Country" name="Country" value="<?php echo htmlspecialchars($record['Country']); ?>" required>
            <label for="Phone">Phone:</label>
            <input type="text" id="Phone" name="Phone" value="<?php echo htmlspecialchars($record['Phone']); ?>" required>
            <input type="submit" value="Update Supplier">
        </form>
    </main>
</body>
</html>

<?php $conn->close(); ?>
