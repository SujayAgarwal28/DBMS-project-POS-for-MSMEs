<?php
include('../db.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $CategoryID = $_GET['id'];

    $sql = "DELETE FROM Category WHERE CategoryID='$CategoryID'";

    if ($conn->query($sql) === TRUE) {
        echo "Category deleted successfully. <a href='list.php'>Back to List</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Category</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Delete Category</h1>
    </header>
    <main>
        <a class="nav-button" href="list.php">Back to List</a>
        <a class="nav-button" href="../index.php">Home</a>
        <p>The category has been deleted.</p>
    </main>
</body>
</html>

<?php $conn->close(); ?>
