<?php
require_once 'init.php';

try {
    // Drop existing tables if they exist
    $tables = [
        'reports',
        'subsidy_applications',
        'policies',
        'market_statistics',
        'deliveries',
        'negotiations',
        'listings',
        'users'
    ];

    foreach ($tables as $table) {
        $pdo->exec("DROP TABLE IF EXISTS $table");
    }

    // Create users table
    $pdo->exec("CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        password VARCHAR(255) NOT NULL,
        role ENUM('farmer', 'trader', 'government') NOT NULL,
        email VARCHAR(100),
        phone VARCHAR(20),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        last_login TIMESTAMP NULL,
        UNIQUE KEY unique_username_role (username, role)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    // Create listings table
    $pdo->exec("CREATE TABLE listings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        farmer_id INT NOT NULL,
        product_name VARCHAR(255) NOT NULL,
        quantity DECIMAL(10,2) NOT NULL,
        price_per_kg DECIMAL(10,2) NOT NULL,
        category ENUM('grains', 'vegetables', 'fruits', 'other') NOT NULL,
        description TEXT,
        status ENUM('active', 'sold', 'inactive') DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (farmer_id) REFERENCES users(id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    // Create negotiations table
    $pdo->exec("CREATE TABLE negotiations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        listing_id INT NOT NULL,
        trader_id INT NOT NULL,
        offered_price DECIMAL(10,2) NOT NULL,
        status ENUM('pending', 'accepted', 'rejected') DEFAULT 'pending',
        notes TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (listing_id) REFERENCES listings(id),
        FOREIGN KEY (trader_id) REFERENCES users(id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    // Create deliveries table
    $pdo->exec("CREATE TABLE deliveries (
        id INT AUTO_INCREMENT PRIMARY KEY,
        listing_id INT NOT NULL,
        trader_id INT NOT NULL,
        status ENUM('pending', 'in_transit', 'completed', 'cancelled') DEFAULT 'pending',
        expected_date DATE NOT NULL,
        actual_date DATE,
        notes TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (listing_id) REFERENCES listings(id),
        FOREIGN KEY (trader_id) REFERENCES users(id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    // Create market_statistics table
    $pdo->exec("CREATE TABLE market_statistics (
        id INT AUTO_INCREMENT PRIMARY KEY,
        total_farmers INT NOT NULL DEFAULT 0,
        active_traders INT NOT NULL DEFAULT 0,
        monthly_transactions DECIMAL(15,2) NOT NULL DEFAULT 0.00,
        last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    // Create policies table
    $pdo->exec("CREATE TABLE policies (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        status ENUM('active', 'pending', 'inactive') DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    // Create subsidy_applications table
    $pdo->exec("CREATE TABLE subsidy_applications (
        id INT AUTO_INCREMENT PRIMARY KEY,
        farmer_id INT NOT NULL,
        amount DECIMAL(15,2) NOT NULL,
        status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
        application_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        processed_date TIMESTAMP NULL,
        processed_by INT NULL,
        notes TEXT,
        FOREIGN KEY (farmer_id) REFERENCES users(id),
        FOREIGN KEY (processed_by) REFERENCES users(id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    // Create reports table
    $pdo->exec("CREATE TABLE reports (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        file_path VARCHAR(255),
        report_type ENUM('market_analysis', 'subsidy_distribution', 'policy_impact') NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        created_by INT NOT NULL,
        FOREIGN KEY (created_by) REFERENCES users(id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    // Insert sample users
    $sampleUsers = [
        ['username' => 'farmer1', 'password' => password_hash('farmer123', PASSWORD_DEFAULT), 'role' => 'farmer'],
        ['username' => 'trader1', 'password' => password_hash('trader123', PASSWORD_DEFAULT), 'role' => 'trader'],
        ['username' => 'gov1', 'password' => password_hash('gov123', PASSWORD_DEFAULT), 'role' => 'government']
    ];

    $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    foreach ($sampleUsers as $user) {
        $stmt->execute([$user['username'], $user['password'], $user['role']]);
    }

    // Insert sample listings
    $stmt = $pdo->prepare("INSERT INTO listings (farmer_id, product_name, quantity, price_per_kg, category, description) VALUES (?, ?, ?, ?, ?, ?)");
    $sampleListings = [
        [1, 'Maize', 1000.00, 150.00, 'grains', 'High-quality maize from local farm'],
        [1, 'Tomatoes', 500.00, 200.00, 'vegetables', 'Fresh organic tomatoes'],
        [1, 'Mangoes', 750.00, 180.00, 'fruits', 'Sweet and juicy mangoes']
    ];
    foreach ($sampleListings as $listing) {
        $stmt->execute($listing);
    }

    // Insert sample market statistics
    $pdo->exec("INSERT INTO market_statistics (total_farmers, active_traders, monthly_transactions) VALUES (2450, 156, 4200000.00)");

    // Insert sample policies
    $stmt = $pdo->prepare("INSERT INTO policies (title, description, status) VALUES (?, ?, ?)");
    $samplePolicies = [
        ['Agricultural Subsidy Program 2024', 'Annual subsidy program for small-scale farmers', 'active'],
        ['Market Price Regulations', 'Regulations for agricultural product pricing', 'pending']
    ];
    foreach ($samplePolicies as $policy) {
        $stmt->execute($policy);
    }

    echo "<h2>Database Setup Completed Successfully!</h2>";
    echo "<h3>Sample Users Created:</h3>";
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>Username</th><th>Password</th><th>Role</th></tr>";
    echo "<tr><td>farmer1</td><td>farmer123</td><td>farmer</td></tr>";
    echo "<tr><td>trader1</td><td>trader123</td><td>trader</td></tr>";
    echo "<tr><td>gov1</td><td>gov123</td><td>government</td></tr>";
    echo "</table>";

    echo "<br><h3>Next Steps:</h3>";
    echo "1. <a href='test_db.php'>Verify the database setup</a><br>";
    echo "2. <a href='index.php'>Go to login page</a>";

} catch(PDOException $e) {
    die("Database setup failed: " . $e->getMessage());
}
?> 