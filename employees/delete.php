<?php
include('../db.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $EmployeeID = $_GET['id'];

    $sql = "DELETE FROM Employee WHERE EmployeeID='$EmployeeID'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully. <a href='list.php'>Back to List</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Employee</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Delete Employee</h1>
    </header>
    <main>
        <a class="nav-button" href="list.php">Back to List</a>
        <a class="nav-button" href="../index.php">Home</a>
        <p>The employee has been deleted.</p>
    </main>
</body>
</html>

<?php $conn->close(); ?>
