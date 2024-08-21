<?php
include('../db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $EmployeeID = $_POST['EmployeeID'];
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $Email = $_POST['Email'];
    $Phone = $_POST['Phone'];
    $Position = $_POST['Position'];
    $HireDate = $_POST['HireDate'];
    $StoreID = $_POST['StoreID'];

    $sql = "UPDATE Employee SET FirstName='$FirstName', LastName='$LastName', Email='$Email', Phone='$Phone', Position='$Position', HireDate='$HireDate', StoreID='$StoreID'
            WHERE EmployeeID='$EmployeeID'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully. <a href='list.php'>Back to List</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} elseif (isset($_GET['id'])) {
    $EmployeeID = $_GET['id'];
    $sql = "SELECT * FROM Employee WHERE EmployeeID='$EmployeeID'";
    $result = $conn->query($sql);
    $record = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
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
            max-width: 800px;
            margin: 20px auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        form {
            display: flex;
            flex-direction: column;
        }
        form label {
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
        }
        form input {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 14px;
        }
        form input[type="submit"] {
            background-color: #007BFF;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        form input[type="submit"]:hover {
            background-color: #0056b3;
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
    </style>
</head>
<body>
    <header>
        <h1>Edit Employee</h1>
    </header>
    <main>
        <a class="nav-button" href="list.php">Back to List</a>
        <a class="nav-button" href="../index.php">Home</a>
        <form method="post" action="" class="form-container">
            <input type="hidden" name="EmployeeID" value="<?php echo $record['EmployeeID']; ?>">
            <label for="FirstName">First Name:</label>
            <input type="text" id="FirstName" name="FirstName" value="<?php echo $record['FirstName']; ?>" required>
            <label for="LastName">Last Name:</label>
            <input type="text" id="LastName" name="LastName" value="<?php echo $record['LastName']; ?>" required>
            <label for="Email">Email:</label>
            <input type="email" id="Email" name="Email" value="<?php echo $record['Email']; ?>" required>
            <label for="Phone">Phone:</label>
            <input type="text" id="Phone" name="Phone" value="<?php echo $record['Phone']; ?>">
            <label for="Position">Position:</label>
            <input type="text" id="Position" name="Position" value="<?php echo $record['Position']; ?>">
            <label for="HireDate">Hire Date:</label>
            <input type="date" id="HireDate" name="HireDate" value="<?php echo $record['HireDate']; ?>">
            <label for="StoreID">Store ID:</label>
            <input type="text" id="StoreID" name="StoreID" value="<?php echo $record['StoreID']; ?>">
            <input type="submit" value="Update Employee">
        </form>
    </main>
</body>
</html>

<?php $conn->close(); ?>
