<?php
include('../db.php');

$EmployeeID = $_GET['id'];
$sql = "SELECT * FROM `Order` WHERE EmployeeID='$EmployeeID'";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html>
    
<head>
    <title>Employee Report</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Employee Report</h1>
    </header>
    <main>
        <a class="nav-button" href="list.php">Back to List</a>
        <a class="nav-button" href="../index.php">Home</a>
        <h2>Orders by Employee ID: <?php echo $EmployeeID; ?></h2>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>Customer ID</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['OrderID']; ?></td>
                        <td><?php echo $row['OrderDate']; ?></td>
                        <td><?php echo $row['CustomerID']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</body>
</html>

<?php $conn->close(); ?>
