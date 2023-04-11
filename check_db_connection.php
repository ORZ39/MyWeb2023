<?php
$servername = "mywebserver2023.mysql.database.azure.com";
$username = "orz1920";
$password = "R.o.123456789";
$dbname = "mydatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
$conn->close();
?>
