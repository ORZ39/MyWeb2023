<?php
session_start();
if(isset($_SESSION['username'])) {
    // User already logged in
    header("Location: dashboard.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input values from form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Connect to database
    require_once('database.php');
    $conn = connect_to_db();

    // Check if user exists
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1) {
        // User exists, check password
        $row = $result->fetch_assoc();
        if(password_verify($password, $row['password'])) {
            // Password is correct, start session and redirect to dashboard
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit();
        } else {
            // Password is incorrect
            $error = "Invalid password";
        }
    } else {
        // User doesn't exist
        $error = "Username not found";
    }
    $stmt->close();
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
        <h2>Login</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <span class="error"><?php echo isset($error) ? $error : ""; ?></span>
            <br>
            <input type="submit" value="Submit">
        </form>
        <p>Don't have an account? <a href="signup.php">Sign up here</a>.</p>
    </div>
</body>
</html>
