<?php
session_start();

if(isset($_SESSION['username'])) {
    // User already logged in
    header("Location: dashboard.php");
    exit();
}

if(isset($_POST['username']) && isset($_POST['password'])) {
    // Form submitted, try to log in
    $username = $_POST['username'];
    $password = $_POST['password'];


    // Query database for user
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($query);

    if($result->num_rows > 0) {
        // User found, log them in
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        // Invalid username/password
        $error = "Invalid username or password.";
    }

    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <div class="form">
            <h2>Login</h2>
            <?php if(isset($error)) { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>
            <form method="post">
                <label for="username">Username:</label>
                <input type="text" name="username" required>
                <label for="password">Password:</label>
                <input type="password" name="password" required>
                <input type="submit" value="Login">
            </form>
        </div>
    </div>
</body>
</html>
