<?php
session_start();

if(isset($_SESSION['username'])) {
    // User already logged in
    header("Location: dashboard.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once('database.php');

    $conn = connect_to_db();

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, password) VALUES ('$username', '$hash')";
    $result = mysqli_query($conn, $query);

    if($result) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    }

    $error_message = "Error creating account.";
}

?>

