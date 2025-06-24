<?php
require_once 'init.php';

try {
    // Test database connection
    echo "<h2>Database Connection Test</h2>";
    echo "Connected successfully to database: " . DB_NAME . "<br><br>";

    // Check users table
    echo "<h2>Users Table Check</h2>";
    $stmt = $pdo->query("SELECT * FROM users");
    $users = $stmt->fetchAll();

    if (count($users) > 0) {
        echo "Found " . count($users) . " users in the database:<br><br>";
        echo "<table border='1' cellpadding='5'>";
        echo "<tr><th>ID</th><th>Username</th><th>Role</th><th>Created At</th></tr>";
        
        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($user['id']) . "</td>";
            echo "<td>" . htmlspecialchars($user['username']) . "</td>";
            echo "<td>" . htmlspecialchars($user['role']) . "</td>";
            echo "<td>" . htmlspecialchars($user['created_at']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No users found in the database.<br>";
        echo "Please run setup_database.php first.<br>";
    }

} catch(PDOException $e) {
    echo "<h2>Error</h2>";
    echo "Database error: " . $e->getMessage() . "<br>";
    echo "Please make sure:<br>";
    echo "1. XAMPP MySQL service is running<br>";
    echo "2. Database 'kilimotz' exists<br>";
    echo "3. You have run setup_database.php<br>";
}
?> 