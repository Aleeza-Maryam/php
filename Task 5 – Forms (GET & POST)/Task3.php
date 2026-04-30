<!-- - Task 3: Create a Student Admission Form with fields:
Name, Age, Department, University
Display submitted data. -->
<form method="post">
    Name: <input type="text" name="name"><br><br>
    Age: <input type="number" name="age"><br><br>
    Department: <input type="text" name="department"><br><br>
    University: <input type="text" name="university"><br><br>
    <input type="submit" value="Submit">
</form>

<?php
if ($_POST) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $department = $_POST['department'];
    $university = $_POST['university'];

    echo "<h3>Submitted Data:</h3>";
    echo "Name: " . $name . "<br>";
    echo "Age: " . $age . "<br>";
    echo "Department: " . $department . "<br>";
    echo "University: " . $university . "<br>";
}
?>

