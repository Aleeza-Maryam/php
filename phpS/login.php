<?php

// ─────────────────────────────────────────────
//  FILE: login.php
//  PURPOSE: Show a login form and start a session
//           when the user logs in successfully
// ─────────────────────────────────────────────

// session_start() MUST be called at the very top of every page that uses sessions
// It either creates a new session OR resumes an existing one
// Sessions store data on the SERVER and give the browser a unique session ID cookie
session_start();

// Include the database connection file
// Now the variable $conn is available in this file
require_once "db_connection.php";

// Create an empty variable to store any error message
$error = "";

// Check if the form was submitted using the POST method
// $_SERVER["REQUEST_METHOD"] tells us how the page was requested
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get the username entered by the user from the form
    // $_POST["username"] reads the value of the input field named "username"
    $username = $_POST["username"];

    // Get the password entered by the user
    $password = $_POST["password"];

    // Sanitize input to prevent basic SQL injection
    // mysqli_real_escape_string() escapes special characters
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Write an SQL query to find the user in the "users" table
    // We check both username AND password match
    // NOTE: In real projects, always use password_hash() and password_verify()
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";

    // Run (execute) the query on the database
    // mysqli_query( connection, sql_query ) returns a result object
    $result = mysqli_query($conn, $query);

    // mysqli_num_rows() counts how many rows were returned
    // If count is 1, the user exists and credentials are correct
    if (mysqli_num_rows($result) == 1) {

        // Fetch the matching row as an associative array
        // mysqli_fetch_assoc() returns one row as key => value pairs
        $user = mysqli_fetch_assoc($result);

        // ── START STORING SESSION DATA ──────────────────
        // $_SESSION is a special PHP array that saves data on the server
        // This data stays available across multiple pages until session ends

        // Store the user's ID from the database into the session
        $_SESSION["user_id"] = $user["id"];

        // Store the username into the session
        $_SESSION["username"] = $user["username"];

        // Store a flag that tells us the user is logged in
        $_SESSION["logged_in"] = true;
        // ── SESSION DATA STORED ─────────────────────────

        // Redirect the user to the dashboard page
        // header("Location: ...") sends the browser to a new page
        header("Location: dashboard.php");

        // exit() stops any further code from running after redirect
        exit();
    } else {
        // If no row was found, credentials are wrong
        $error = "❌ Invalid username or password!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <style>
        /* Basic styling for a clean centered login form */
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .box {
            background: white;
            padding: 35px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 320px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color:
                #555;
            font-size: 14px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 11px;
            background: #4A90E2;
            color: white;
            border:
                none;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
        }

        button:hover {
            background: #357ABD;
        }

        .error {
            color: red;
            font-size: 13px;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="box">
        <h2>🔐 Login</h2>

        <?php
        // If the $error variable is not empty, display it on the page
        if (!empty($error)) {
            echo "<p class='error'>$error</p>";
        }
        ?>

        <!-- HTML form — action="" means submit to the same file (login.php) -->
        <!-- method="post" sends data securely in the request body (not in the URL) -->
        <form action="" method="post">

            <label for="username">Username</label>
            <!-- name="username" is how PHP reads this field using $_POST["username"] -->
            <input type="text" name="username" id="username" placeholder="Enter username" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter password" required>

            <!-- Clicking this button submits the form -->
            <button type="submit">Login</button>



        </form>
    </div>

</body>

</html>