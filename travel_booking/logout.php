<?php

session_start();

// Step 1: Clear all session variables
session_unset();

// Step 2: Destroy the session completely
session_destroy();


header("Location: login.php?msg=bye");
exit();
?>