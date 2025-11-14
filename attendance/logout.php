<?php
session_start();

// Remove session variables
session_unset();

// Destroy session
session_destroy();

// Remove cookie if exists
setcookie("remember_user", "", time() - 3600, "/");

header("Location:index.php");
exit;
?>
