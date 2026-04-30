<!DOCTYPE html>
<html>
<head>
<title>Student Registration</title>
</head>
<body>
<h2>Student Registration Form</h2>
<form method="post">
Name: <input type="text" name="name"><br><br>
Age: <input type="number" name="age"><br><br>
Course: <input type="text" name="course"><br><br>
<input type="submit" name="submit" value="Register">
</form>

<?php
if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $course = $_POST['course'];

    echo "<h3>Student Information</h3>";
    echo "Name: " . $name . "<br>";
    echo "Age: " . $age . "<br>";
    echo "Course: " . $course;
}
?>
</body>
</html>