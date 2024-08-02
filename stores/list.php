<?php
include('../db.php');

$sql = "SELECT * FROM Store";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
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

<head>
    <title>Store List</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Store List</h1>
    </header>
    <main>
        <a class="nav-button" href="add.php">Add Store</a>
        <a class="nav-button" href="../index.php">Home</a>
        <table>
            <thead>
                <tr>
                    <th>Store ID</th>
                    <th>Store Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['StoreID']); ?></td>
                        <td><?php echo htmlspecialchars($row['StoreName']); ?></td>
                        <td><?php echo htmlspecialchars($row['Address']); ?></td>
                        <td><?php echo htmlspecialchars($row['Phone']); ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['StoreID']; ?>">Edit</a> |
                            <a href="delete.php?id=<?php echo $row['StoreID']; ?>" onclick="return confirm('Are you sure you want to delete this store?');">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</body>
</html>

<?php $conn->close(); ?>
