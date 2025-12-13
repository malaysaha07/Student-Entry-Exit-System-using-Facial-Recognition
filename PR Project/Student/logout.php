<?php
// logout.php - clears the session and redirects to index.php
session_start();

// Unset all session variables
$_SESSION = [];

// Destroy session cookie (if one was set)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroy the session
session_destroy();

// Redirect to login page (index.php)
header("Location:\PHP\PR Project\Home\index.php");
exit;
