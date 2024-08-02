<?php
include('../db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $StoreID = $_POST['StoreID'];
    $StoreName = $_POST['StoreName'];
    $Address = $_POST['Address'];
    $Phone = $_POST['Phone'];

    $sql = "UPDATE Store SET StoreName='$StoreName', Address='$Address', Phone='$Phone' WHERE StoreID='$StoreID'";

    if ($conn->query($sql) === TRUE) {
        echo "Store updated successfully. <a href='list.php'>Back to List</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} elseif (isset($_GET['id'])) {
    $StoreID = $_GET['id'];
    $sql = "SELECT * FROM Store WHERE StoreID='$StoreID'";
    $result = $conn->query($sql);
    $record = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Store</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Edit Store</h1>
    </header>
    <main>
        <a class="nav-button" href="list.php">Back to List</a>
        <a class="nav-button" href="../index.php">Home</a>
        <form method="post" action="" class="form-container">
            <input type="hidden" name="StoreID" value="<?php echo htmlspecialchars($record['StoreID']); ?>">
            <label for="StoreName">Store Name:</label>
            <input type="text" id="StoreName" name="StoreName" value="<?php echo htmlspecialchars($record['StoreName']); ?>" required>
            <label for="Address">Address:</label>
            <input type="text" id="Address" name="Address" value="<?php echo htmlspecialchars($record['Address']); ?>" required>
            <label for="Phone">Phone:</label>
            <input type="text" id="Phone" name="Phone" value="<?php echo htmlspecialchars($record['Phone']); ?>" required>
            <input type="submit" value="Update Store">
        </form>
    </main>
</body>
</html>

<?php $conn->close(); ?>
