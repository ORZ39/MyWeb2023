<?php
session_start();

if(isset($_SESSION['username'])) {
    // User already logged in
    header("Location: dashboard.php");
    exit();
}

if(isset($_POST['username']) && isset($_POST['password'])) {
    // Form submitted, try to sign up
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Connect to database
    $conn = new mysqli("mywebserver2023.mysql.database.azure.com", "orz1920", "R.o.123456789", "mydatabase");

    // Check connection
    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query database for user
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($query);

    if($result->num_rows > 0) {
        // User already exists
        $error = "Username already taken.";
    } else {
        // User does not exist, create account
        $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        if($conn->query($query) === TRUE) {
            // Account created successfully
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit();
        } else {
            // Account creation failed
            $error = "Account creation failed. Please try again later.";
        }
    }

    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
   
