<?php
// Initialize variables
$name = $email = $cnic = $age = "";
$name_err = $email_err = $cnic_err = $age_err = "";
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // VALIDATE NAME
    $name = trim($_POST['name']);
    if (empty($name)) {
        $name_err = "Name is required.";
    } elseif (strlen($name) > 30) {
        $name_err = "Name must not exceed 30 characters.";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $name)) {
        $name_err = "Name can only have letters and spaces.";
    } else {
        $name = htmlspecialchars($name);
    }

    // VALIDATE EMAIL
    $email = trim($_POST['email']);
    if (empty($email)) {
        $email_err = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    } else {
        $email = htmlspecialchars($email);
    }

    // VALIDATE CNIC
    $cnic = trim($_POST['cnic']);
    if (empty($cnic)) {
        $cnic_err = "CNIC is required.";
    } elseif (!preg_match("/^[0-9]{13}$/", $cnic)) {
        $cnic_err = "CNIC must be exactly 13 digits.";
    } else {
        $cnic = htmlspecialchars($cnic);
    }

    // VALIDATE AGE
    $age = trim($_POST['age']);
    if (empty($age)) {
        $age_err = "Age is required.";
    } elseif (!is_numeric($age)) {
        $age_err = "Age must be a number.";
    } elseif ((int)$age < 10 || (int)$age > 100) {
        $age_err = "Age must be between 10 and 100.";
    } else {
        $age = (int)$age;
    }

    // FINAL CHECK
    if (empty($name_err) && empty($email_err) && empty($cnic_err) && empty($age_err)) {
        $success = true;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Server Side Form Validation</title>
</head>
<body>

<h2>Student Information Form</h2>

<form method="post" action="">
    Full Name * <br>
    <input type="text" name="name" value="<?php echo $name; ?>">
    <span style="color:red"><?php echo $name_err; ?></span>
    <br><br>

    Email Address * <br>
    <input type="text" name="email" value="<?php echo $email; ?>">
    <span style="color:red"><?php echo $email_err; ?></span>
    <br><br>

    CNIC Number * <br>
    <input type="text" name="cnic" value="<?php echo $cnic; ?>">
    <span style="color:red"><?php echo $cnic_err; ?></span>
    <br><br>

    Age * <br>
    <input type="text" name="age" value="<?php echo $age; ?>">
    <span style="color:red"><?php echo $age_err; ?></span>
    <br><br>

    <input type="submit" value="Submit Form">
</form>

<?php
if ($success) {
    echo "<h3>Form Submitted Successfully!</h3>";
    echo "Name: " . $name . "<br>";
    echo "Email: " . $email . "<br>";
    echo "CNIC: " . $cnic . "<br>";
    echo "Age: " . $age . " years<br>";
}
?>

</body>
</html>