<?php
include('../db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $CategoryID = $_POST['CategoryID'];
    $CategoryName = $_POST['CategoryName'];
    $Description = $_POST['Description'];

    $sql = "UPDATE Category SET CategoryName='$CategoryName', Description='$Description'
            WHERE CategoryID='$CategoryID'";

    if ($conn->query($sql) === TRUE) {
        echo "Category updated successfully. <a href='list.php'>Back to List</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} elseif (isset($_GET['id'])) {
    $CategoryID = $_GET['id'];
    $sql = "SELECT * FROM Category WHERE CategoryID='$CategoryID'";
    $result = $conn->query($sql);
    $record = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Category</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Edit Category</h1>
    </header>
    <main>
        <a class="nav-button" href="list.php">Back to List</a>
        <a class="nav-button" href="../index.php">Home</a>
        <form method="post" action="" class="form-container">
            <input type="hidden" name="CategoryID" value="<?php echo $record['CategoryID']; ?>">
            <label for="CategoryName">Category Name:</label>
            <input type="text" id="CategoryName" name="CategoryName" value="<?php echo $record['CategoryName']; ?>" required>
            <label for="Description">Description:</label>
            <input type="text" id="Description" name="Description" value="<?php echo $record['Description']; ?>" required>
            <input type="submit" value="Update Category">
        </form>
    </main>
</body>
</html>

<?php $conn->close(); ?>
