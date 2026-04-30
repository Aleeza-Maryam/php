<!DOCTYPE html>
<html>
<head>
    <title>GET Method Example</title>
</head>
<body>
    <h2>Enter Student Name</h2>
    <!-- Simple form using GET method -->
    <form method="get">
        Name: <input type="text" name="name">
        <input type="submit" value="Submit">
    </form>

    <?php
    // ✅ Option 1: Using isset()
    // This checks if the 'name' parameter exists in the URL before using it.
    if (isset($_GET['name'])) {
        $name = $_GET['name'];
        echo "Student Name (isset): " . htmlspecialchars($name) . "<br>";
    } else {
        echo "Student Name (isset): Not provided<br>";
    }

    // ✅ Option 2: Using null coalescing operator (??)
    // This provides a default value if 'name' is missing.
    $name = $_GET['name'] ?? "Not provided";
    echo "Student Name (??): " . htmlspecialchars($name);
    ?>
</body>
</html>