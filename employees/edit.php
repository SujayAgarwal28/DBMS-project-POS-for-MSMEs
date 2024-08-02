<?php
include('../db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $EmployeeID = $_POST['EmployeeID'];
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $Email = $_POST['Email'];
    $Phone = $_POST['Phone'];
    $Position = $_POST['Position'];
    $HireDate = $_POST['HireDate'];
    $StoreID = $_POST['StoreID'];

    $sql = "UPDATE Employee SET FirstName='$FirstName', LastName='$LastName', Email='$Email', Phone='$Phone', Position='$Position', HireDate='$HireDate', StoreID='$StoreID'
            WHERE EmployeeID='$EmployeeID'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully. <a href='list.php'>Back to List</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} elseif (isset($_GET['id'])) {
    $EmployeeID = $_GET['id'];
    $sql = "SELECT * FROM Employee WHERE EmployeeID='$EmployeeID'";
    $result = $conn->query($sql);
    $record = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Edit Employee</h1>
    </header>
    <main>
        <a class="nav-button" href="list.php">Back to List</a>
        <a class="nav-button" href="../index.php">Home</a>
        <form method="post" action="" class="form-container">
            <input type="hidden" name="EmployeeID" value="<?php echo $record['EmployeeID']; ?>">
            <label for="FirstName">First Name:</label>
            <input type="text" id="FirstName" name="FirstName" value="<?php echo $record['FirstName']; ?>" required>
            <label for="LastName">Last Name:</label>
            <input type="text" id="LastName" name="LastName" value="<?php echo $record['LastName']; ?>" required>
            <label for="Email">Email:</label>
            <input type="text" id="Email" name="Email" value="<?php echo $record['Email']; ?>" required>
            <label for="Phone">Phone:</label>
            <input type="text" id="Phone" name="Phone" value="<?php echo $record['Phone']; ?>">
            <label for="Position">Position:</label>
            <input type="text" id="Position" name="Position" value="<?php echo $record['Position']; ?>">
            <label for="HireDate">Hire Date:</label>
            <input type="date" id="HireDate" name="HireDate" value="<?php echo $record['HireDate']; ?>">
            <label for="StoreID">Store ID:</label>
            <input type="text" id="StoreID" name="StoreID" value="<?php echo $record['StoreID']; ?>">
            <input type="submit" value="Update Employee">
        </form>
    </main>
</body>
</html>

<?php $conn->close(); ?>
