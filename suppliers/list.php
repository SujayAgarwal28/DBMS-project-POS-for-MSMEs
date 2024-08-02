<?php
include('../db.php');

$sql = "SELECT * FROM Supplier";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Supplier List</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<style>table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}</style>
    <header>
        <h1>Supplier List</h1>
    </header>
    <main>
        <a class="nav-button" href="add.php">Add Supplier</a>
        <a class="nav-button" href="../index.php">Home</a>
        <table>
            <thead>
                <tr>
                    <th>Supplier ID</th>
                    <th>Supplier Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['SupplierID']); ?></td>
                        <td><?php echo htmlspecialchars($row['SupplierName']); ?></td>
                        <td><?php echo htmlspecialchars($row['Phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['Address']); ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['SupplierID']; ?>">Edit</a> |
                            <a href="delete.php?id=<?php echo $row['SupplierID']; ?>" onclick="return confirm('Are you sure you want to delete this supplier?');">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</body>
</html>

<?php $conn->close(); ?>
