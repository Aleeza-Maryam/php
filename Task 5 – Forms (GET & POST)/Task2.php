<!-- - Task 2: Create a Login Form with fields:
Username, Password
Display:
Login Successful
-  -->
<form method="post">
    Username: <input type="text" name="username"><br><br>
    Password: <input type="password" name="password"><br><br>
    <input type="submit" value="Login">
</form>

<?php
if ($_POST) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Simple validation (replace with actual authentication logic)
    if ($username === "admin" && $password === "password") {
        echo "<h3>Login Successful</h3>";
        echo "Welcome, " . $username . "!";
    } else {
        echo "<h3>Login Failed</h3>";
        echo "Invalid username or password.";
    }
}
?>

