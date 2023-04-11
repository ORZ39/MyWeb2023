<?php
session_start();

if(!isset($_SESSION['username'])) {
    // User not logged in
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $username; ?></h2>
        <p>Your dashboard content goes here.</p>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
