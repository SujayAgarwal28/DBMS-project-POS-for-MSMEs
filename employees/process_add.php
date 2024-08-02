<?php
include('../db.php');

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$position = $_POST['position'];
$hire_date = $_POST['hire_date'];
$store_id = $_POST['store_id'];

// Insert new employee
$sql = "INSERT INTO Employee (FirstName, LastName, Email, Phone, Position, HireDate, StoreID)
        VALUES ('$first_name', '$last_name', '$email', '$phone', '$position', '$hire_date', $store_id)";

if ($conn->query($sql) === TRUE) {
    echo "New employee added successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
