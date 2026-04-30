<!DOCTYPE html>
<html>
<head>
    <title>POST Method Example</title>
</head>
<body>
    <h2>Welcome</h2>
    <!-- Simple form using POST method -->
    <form method="post">
        Name: <input type="text" name="username">
        <input type="submit" value="Submit">
    </form>

    <?php
    // ✅ Option 1: Using isset()
    // This checks if the 'username' field exists in $_POST before using it.
    if (isset($_POST['username'])) {
        $name = $_POST['username'];
        echo "Welcome " . htmlspecialchars($name) . "<br>";
    } 
    ?>
</body>
</html>