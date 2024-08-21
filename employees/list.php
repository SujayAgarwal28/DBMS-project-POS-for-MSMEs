<?php
include('../db.php');

$sql = "SELECT * FROM Employee";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees List</title>
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
        header .home-button {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            transition: background 0.3s ease;
        }
        header .home-button:hover {
            background-color: #218838;
        }
        main {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
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
        .actions a {
            margin-right: 10px;
            color: #007BFF;
            text-decoration: none;
        }
        .actions a:hover {
            color: #0056b3;
        }
        @media screen and (max-width: 768px) {
            table, th, td {
                display: block;
                width: 100%;
            }
            table tr {
                margin-bottom: 15px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            }
            .nav-button {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Employees List</h1>
        <a class="home-button" href="../index.php">Home</a>
    </header>
    <main>
        <a class="nav-button" href="add.php">Add Employee</a>
        
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Position</th>
                        <th>Hire Date</th>
                        <th>Store ID</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['EmployeeID']; ?></td>
                            <td><?php echo $row['FirstName']; ?></td>
                            <td><?php echo $row['LastName']; ?></td>
                            <td><?php echo $row['Email']; ?></td>
                            <td><?php echo $row['Phone']; ?></td>
                            <td><?php echo $row['Position']; ?></td>
                            <td><?php echo $row['HireDate']; ?></td>
                            <td><?php echo $row['StoreID']; ?></td>
                            <td class="actions">
                                <a href="edit.php?id=<?php echo $row['EmployeeID']; ?>">Edit</a>
                                <a href="delete.php?id=<?php echo $row['EmployeeID']; ?>" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</a>
                                <a href="employee_report.php?employee_id=<?php echo $row['EmployeeID']; ?>">Report</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No employees found.</p>
        <?php endif; ?>
    </main>
</body>
</html>

<?php $conn->close(); ?>
