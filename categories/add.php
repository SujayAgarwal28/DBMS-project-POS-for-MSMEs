<?php
include('../db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $CategoryID = $_POST['CategoryID'];
    $CategoryName = $_POST['CategoryName'];
    

    $sql = "INSERT INTO Category (CategoryID, CategoryName )
            VALUES ('$CategoryID', '$CategoryName' )";

    if ($conn->query($sql) === TRUE) {
        echo "New category added successfully. <a href='list.php'>Back to List</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Add Category</h1>
    </header>
    <main>
        <a class="nav-button" href="list.php">Back to List</a>
        <a class="nav-button" href="../index.php">Home</a>
        <form method="post" action="" class="form-container">
            <label for="CategoryID">Category ID:</label>
            <input type="text" id="CategoryID" name="CategoryID" required>
            <label for="CategoryName">Category Name:</label>
            <input type="text" id="CategoryName" name="CategoryName" required>
            
            <input type="submit" value="Add Category">
        </form>
    </main>
</body>
</html>

<?php $conn->close(); ?>
