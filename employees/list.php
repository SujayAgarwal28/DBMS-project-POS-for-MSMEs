<?php
include('../db.php');

$sql = "SELECT * FROM Employee";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html></html>
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
    <title>Employees List</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Employees List</h1>
        <a href="../index.php" class="home-button">Home</a>
    </header>
    <main>
    <a class="nav-button" href="add.php">Add Employee</a>
    <a class="nav-button" href="../index.php">Home</a>
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
                            <td>
                                <a href="edit.php?id=<?php echo $row['EmployeeID']; ?>">Edit</a>
                                <a href="delete.php?id=<?php echo $row['EmployeeID']; ?>">Delete</a>
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
