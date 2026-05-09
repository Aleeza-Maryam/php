<?php
include __DIR__ . '/db.php'; // Corrected from nclude

// Task 2: Create Record
if (isset($_POST['save'])) { // Corrected from f
    $name = $_POST['name'];
    $email = $_POST['email'];
    $dept = $_POST['department'];

    mysqli_query($conn, "INSERT INTO students (name, email, department) VALUES ('$name', '$email', '$dept')");
    header('location: index.php');
}

// Task 5: Delete Record
if (isset($_GET['delete'])) { // Corrected from f
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM students WHERE id=$id");
    header('location: index.php');
}

// Task 4: Update Record
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $dept = $_POST['department'];

    mysqli_query($conn, "UPDATE students SET name='$name', email='$email', department='$dept' WHERE id=$id");
    header('location: index.php');
}
?>