<?php
session_start();

// Clear the session data
session_unset();
session_destroy();

// Redirect to the login page or any other desired page
header("Location: login.php");
exit;
?>
