<?php

// ─────────────────────────────────────────────
//  FILE: dashboard.php
//  PURPOSE: A protected page — only accessible
//           if the user is logged in (has a session)
// ─────────────────────────────────────────────

// Always call session_start() at the top to access session data
// Without this, $_SESSION will be empty
session_start();

// ── SESSION PROTECTION CHECK ────────────────────────────────
// Check if the session variable "logged_in" exists AND is true
// isset() returns true if a variable exists and is not null
// If the user is NOT logged in, send them back to the login page

// Case 1: Variable not set
// $_SESSION["logged_in"] is missing
//!isset($_SESSION["logged_in"])  // TRUE ✅

// Case 2: Variable exists
//$_SESSION["logged_in"] = true;
//!isset($_SESSION["logged_in"])  // FALSE ❌

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {

    // Redirect to login page if session is missing
    header("Location: login.php");

    // Stop the rest of this page from loading
    exit();
}
// ── SESSION CHECK PASSED — user is logged in ─────────────────

// Read the username from the session
// This was stored in login.php when the user logged in
$username = $_SESSION["username"];

// Read the user ID from the session
$user_id = $_SESSION["user_id"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
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
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 360px;
        }

        h2 {
            color: #333;
        }

        p {
            color: #666;
            font-size: 15px;
        }

        .info {
            background: #f8f9ff;
            border: 1px solid #dde3ff;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            text-align: left;
            font-size: 14px;
            color: #444;
        }

        .info span {
            font-weight: bold;
            color: #4A90E2;
        }

        a.logout {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 25px;
            background: #e74c3c;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
        }

        a.logout:hover {
            background: #c0392b;
        }
    </style>
</head>

<body>

    <div class="box">

        <h2>✅ Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
        <!-- htmlspecialchars() converts special characters to safe HTML — prevents XSS attacks -->

        <p>You are now logged in. Your session is active.</p>

        <!-- Show the session data stored on the server -->
        <div class="info">
            <!-- Display the user ID from session -->
            <p>🆔 User ID: <span><?php echo $user_id; ?></span></p>

            <!-- Display the username from session -->
            <p>👤 Username: <span><?php echo htmlspecialchars($username); ?></span></p>

            <!-- Display the Session ID (the unique key PHP creates for this session) -->
            <!-- session_id() returns the current session ID string -->
            <p>🔑 Session ID: <span><?php echo session_id(); ?></span></p>


            <h1> BSCS-6B</h1>
        </div>

        <!-- Link to logout.php to end the session -->
        <a href="logout.php" class="logout">🚪 Logout</a>

    </div>

</body>

</html>