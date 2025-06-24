<?php
// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error.log');

// Session configuration - must be set before session starts
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.cookie_secure', 0); // Set to 1 if using HTTPS
    session_start();
}

// Database configuration for XAMPP
define('DB_HOST', 'localhost');
define('DB_NAME', 'kilimotz');
define('DB_USER', 'root');  // XAMPP default username
define('DB_PASS', '');      // XAMPP default password is empty

// Application configuration
define('SITE_NAME', 'KilimoTz');
define('SITE_URL', 'http://localhost/kilimotz');
?> 