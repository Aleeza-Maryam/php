<?php

// ─────────────────────────────────────────────
//  FILE: logout.php
//  PURPOSE: Destroy the session and log the user out
//           Then redirect back to the login page
// ─────────────────────────────────────────────

// Must call session_start() first before you can destroy a session
// You can't touch the session unless you've started it
session_start();

// ── STEP 1: Clear all session variables ──────
// $_SESSION = [] sets the session array to empty
// This removes all data stored in the session (username, user_id, logged_in, etc.)
$_SESSION = [];

// ── STEP 2: Delete the session cookie from the browser ──────
// When a session starts, PHP sends a cookie (usually named PHPSESSID) to the browser
// ini_get("session.use_cookies") checks if session cookies are enabled
if (ini_get("session.use_cookies")) {

    // session_get_cookie_params() returns the current cookie settings
    // (lifetime, path, domain, secure, httponly)
    $params = session_get_cookie_params();

    // setcookie() overwrites the session cookie with an expired time (1 = Jan 1, 1970)
    // This tells the browser to delete this cookie immediately
    setcookie(
        session_name(),         // Name of the cookie (e.g. "PHPSESSID")
        '',                     // Empty value
        1,                      // Expire time in the past → browser deletes it
        $params["path"],        // Cookie path (same as original)
        $params["domain"],      // Cookie domain (same as original)
        $params["secure"],      // Secure flag (same as original)
        $params["httponly"]     // HttpOnly flag (same as original)
    );
}

// ── STEP 3: Destroy the session on the SERVER ──────
// session_destroy() deletes the session file/data stored on the server
// After this, the session ID is no longer valid
session_destroy();

// ── STEP 4: Redirect to login page ──────
// After logout, send the user back to the login page
header("Location: login.php");

// Stop any further code from running
exit();
