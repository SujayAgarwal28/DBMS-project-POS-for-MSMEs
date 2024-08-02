<?php
include('../db.php');

$sql = "SELECT * FROM Category";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Category List</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
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
}
</style>
<body>
    <header>
        <h1>Category List</h1>
    </header>
    <main>
    <div class="button-container">

        <a class="nav-button" href="add.php">Add Category</a>
        <a class="nav-button" href="../index.php">Home</a>
    </div>
        <table>
            <thead>
                <tr>
                    <th>Category ID</th>
                    <th>Category Name</th>
                  
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['CategoryID']); ?></td>
                        <td><?php echo htmlspecialchars($row['CategoryName']); ?></td>
                        
                        <td>
                            <a href="edit.php?id=<?php echo $row['CategoryID']; ?>">Edit</a> |
                            <a href="delete.php?id=<?php echo $row['CategoryID']; ?>" onclick="return confirm('Are you sure you want to delete this category?');">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</body>
</html>

<?php $conn->close(); ?>
