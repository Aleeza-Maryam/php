<?php
// ─────────────────────────────────────────────
//  FILE: db_connection.php
//  PURPOSE: Connect to the MySQL database
//           This file is included in other files
//           wherever a database connection is needed
// ─────────────────────────────────────────────

// Database server address (localhost = your own computer / XAMPP)
$host = "localhost";

// MySQL username (default in XAMPP is "root")
$username = "root";

// MySQL password (default in XAMPP is empty "")
$password = "";

// The name of the database you created in phpMyAdmin
$database = "session_demo";

// Create a new connection using mysqli (MySQL Improved)
// mysqli_connect( host, username, password, database_name )
$conn = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
// mysqli_connect_error() returns the error message if connection failed
if (!$conn) {
    // die() stops the script immediately and shows the error message
    die("❌ Connection Failed: " . mysqli_connect_error());
}

// If we reach this point, connection is successful
// (No need to echo anything here; this file is just included silently)
