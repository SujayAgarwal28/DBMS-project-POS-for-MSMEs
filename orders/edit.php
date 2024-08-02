<?php
include('../db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $OrderID = $_POST['OrderID'];
    $OrderDate = $_POST['OrderDate'];
    $CustomerID = $_POST['CustomerID'];
    $EmployeeID = $_POST['EmployeeID'];

    $sql = "UPDATE `Order` SET OrderDate='$OrderDate', CustomerID='$CustomerID', EmployeeID='$EmployeeID'
            WHERE OrderID='$OrderID'";

    if ($conn->query($sql) === TRUE) {
        echo "Order updated successfully. <a href='list.php'>Back to List</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} elseif (isset($_GET['id'])) {
    $OrderID = $_GET['id'];
    $sql = "SELECT * FROM `Order` WHERE OrderID='$OrderID'";
    $result = $conn->query($sql);
    $record = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Order</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Edit Order</h1>
    </header>
    <main>
        <a class="nav-button" href="list.php">Back to List</a>
        <a class="nav-button" href="../index.php">Home</a>
        <form method="post" action="" class="form-container">
            <input type="hidden" name="OrderID" value="<?php echo $record['OrderID']; ?>">
            <label for="OrderDate">Order Date:</label>
            <input type="date" id="OrderDate" name="OrderDate" value="<?php echo $record['OrderDate']; ?>" required>
            <label for="CustomerID">Customer ID:</label>
            <input type="text" id="CustomerID" name="CustomerID" value="<?php echo $record['CustomerID']; ?>" required>
            <label for="EmployeeID">Employee ID:</label>
            <input type="text" id="EmployeeID" name="EmployeeID" value="<?php echo $record['EmployeeID']; ?>" required>
            <input type="submit" value="Update Order">
        </form>
    </main>
</body>
</html>

<?php $conn->close(); ?>
