<?php
// Start the session (if not already started)
session_start();

// Clear all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to sign-in page or home page
header("Location: Sign_In.php");
exit();
?>