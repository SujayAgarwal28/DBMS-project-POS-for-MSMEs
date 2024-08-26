<?php
include('../db.php');

$sql = "SELECT * FROM Category";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category List</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #007BFF;
            color: white;
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        header h1 {
            margin: 0;
            font-size: 28px;
        }
        main {
            padding: 20px;
            max-width: 1200px;
            margin: 20px auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .button-container {
            margin-bottom: 20px;
        }
        .nav-button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 5px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            transition: background 0.3s ease;
        }
        .nav-button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        table th, table td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #007BFF;
            color: white;
        }
        table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        table tr:hover {
            background-color: #e9ecef;
        }
    </style>
</head>
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
