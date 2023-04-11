<?php
function connect_to_db() {
    $servername = "mywebserver2023.mysql.database.azure.com";
    $username = "orz1920";
    $password = "R.o.123456789";
    $dbname = "mydatabase";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
?>
