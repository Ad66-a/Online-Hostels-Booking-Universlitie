<?php
// Load configuration
require_once 'config.php';

// Set default timezone
date_default_timezone_set('Africa/Dar_es_Salaam');

// Set error handling
function handleError($errno, $errstr, $errfile, $errline) {
    error_log("Error [$errno] $errstr on line $errline in file $errfile");
    return true;
}
set_error_handler('handleError');

// Set exception handling
function handleException($exception) {
    error_log("Uncaught Exception: " . $exception->getMessage());
    if (ini_get('display_errors')) {
        echo "An error occurred. Please try again later.";
    }
}
set_exception_handler('handleException');

// Function to check if database exists and create it if it doesn't
function ensureDatabaseExists() {
    try {
        // First connect without database name
        $pdo = new PDO(
            "mysql:host=" . DB_HOST,
            DB_USER,
            DB_PASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]
        );

        // Check if database exists
        $stmt = $pdo->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . DB_NAME . "'");
        if (!$stmt->fetch()) {
            // Create database if it doesn't exist
            $pdo->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME . " CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        }

        // Now connect to the specific database
        $pdo = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
            DB_USER,
            DB_PASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]
        );

        return $pdo;
    } catch(PDOException $e) {
        error_log("Database initialization error: " . $e->getMessage());
        throw new Exception("Database connection failed. Please check your configuration.");
    }
}

// Initialize database connection
try {
    $pdo = ensureDatabaseExists();
} catch(Exception $e) {
    die("Connection failed. Please try again later.");
}

// Load helper functions
require_once 'db.php';
?> 