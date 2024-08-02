<?php
include('../db.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $SupplierID = $_GET['id'];

    $sql = "DELETE FROM Supplier WHERE SupplierID='$SupplierID'";

    if ($conn->query($sql) === TRUE) {
        echo "Supplier deleted successfully. <a href='list.php'>Back to List</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Supplier</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Delete Supplier</h1>
    </header>
    <main>
        <a class="nav-button" href="list.php">Back to List</a>
        <a class="nav-button" href="../index.php">Home</a>
        <p>The supplier has been deleted.</p>
    </main>
</body>
</html>

<?php $conn->close(); ?>
