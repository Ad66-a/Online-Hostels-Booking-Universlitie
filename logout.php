<?php
session_start();
session_destroy();

// Clear cookies
setcookie('username', '', time() - 3600, "/");
setcookie('role', '', time() - 3600, "/");

// Redirect to index page
header("Location: index.php");
exit();
