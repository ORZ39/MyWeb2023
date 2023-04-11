<?php
session_start();

if(!isset($_SESSION['username'])) {
    // User not logged in, redirect to login page
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
        <p>This is your dashboard.</p>
        <form action="logout.php">
            <input type="submit" value="Logout">
        </form>
    </div>
</body>
</html>
