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

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        if(password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit();
        }
    }

    $error_message = "Invalid username or password.";
}

?>

