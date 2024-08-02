<?php
include('../db.php');

if (isset($_GET['id'])) {
    $CategoryID = $_GET['id'];
    $sql = "SELECT * FROM Category WHERE CategoryID='$CategoryID'";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Category Report</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Category Report</h1>
    </header>
    <main>
        <a class="nav-button" href="list.php">Back to List</a>
        <a class="nav-button" href="../index.php">Home</a>
        <h2>Category Details</h2>
        <table>
            <thead>
                <tr>
                    <th>Category ID</th>
                    <th>Category Name</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($result) && $row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['CategoryID']); ?></td>
                        <td><?php echo htmlspecialchars($row['CategoryName']); ?></td>
                        <td><?php echo htmlspecialchars($row['Description']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</body>
</html>

<?php $conn->close(); ?>
