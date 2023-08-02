<?php
// Start the session
session_start();

// Clear all session variables and destroy the session
session_unset();
session_destroy();

// Redirect the user to the login page
header('Location: login.php');
exit(); // Make sure to exit after redirecting
?>
