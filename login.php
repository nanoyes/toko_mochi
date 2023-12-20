<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'koneksi.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $mysqli->query($query);

    if ($result->num_rows == 1) {
        $_SESSION['username'] = $username;
        header("location: dashboard.php");
    } else {
        $error = "Invalid username or password";
    }
}

$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Add your head content here -->
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>
    <?php
    if (isset($error)) {
        echo "<p>$error</p>";
    }
    ?>
</body>
</html>
