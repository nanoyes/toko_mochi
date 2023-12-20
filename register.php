<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    $result = $mysqli->query($query);

    if ($result) {
        header("location: login.php");
    } else {
        $error = "Registration failed. Please try again.";
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
    <h2>Register</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Register">
    </form>
    <?php
    if (isset($error)) {
        echo "<p>$error</p>";
    }
    ?>
</body>
</html>
