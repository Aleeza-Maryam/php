<!-- - Task 1: Create a form that asks:
Name, Email, Phone Number
Display the entered data using PHP. -->
<form method="post">
    Name: <input type="text" name="name"><br><br>
    Email: <input type="email" name="email"><br><br>
    Phone Number: <input type="tel" name="phone"><br><br>
    <input type="submit" value="Submit">
</form>

<?php
if ($_POST) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    echo "<h3>Entered Data:</h3>";
    echo "Name: " . $name . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Phone Number: " . $phone . "<br>";
}
?>
