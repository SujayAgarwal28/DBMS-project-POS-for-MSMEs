<?php
$servername = "localhost";
$username = "root";
$password = ""; // Your MySQL password
$database = "RetailStore";
$port = 3307; // Update this if necessary

// Create connection
$conn = new mysqli($servername, $username, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
