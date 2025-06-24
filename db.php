<?php
// Helper function to check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']) && isset($_SESSION['username']) && isset($_SESSION['role']);
}

// Helper function to check user role
function hasRole($role) {
    return isLoggedIn() && $_SESSION['role'] === $role;
}

// Helper function to redirect with message
function redirect($url, $message = '', $type = 'success') {
    if ($message) {
        $_SESSION['flash_message'] = $message;
        $_SESSION['flash_type'] = $type;
    }
    header("Location: $url");
    exit();
}

// Helper function to display flash messages
function displayFlashMessage() {
    if (isset($_SESSION['flash_message'])) {
        $type = $_SESSION['flash_type'] ?? 'success';
        $message = $_SESSION['flash_message'];
        unset($_SESSION['flash_message'], $_SESSION['flash_type']);
        return "<div class='alert alert-{$type} alert-dismissible fade show' role='alert'>
                    {$message}
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
    }
    return '';
}

// Helper function to sanitize input
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Helper function to validate email
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Helper function to validate phone number
function isValidPhone($phone) {
    return preg_match('/^\+?[1-9]\d{1,14}$/', $phone);
}

// Helper function to format currency
function formatCurrency($amount) {
    return '₦' . number_format($amount, 2);
}

// Helper function to get user details
function getUserDetails($userId) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch();
    } catch(PDOException $e) {
        error_log("Error fetching user details: " . $e->getMessage());
        return false;
    }
}

// Helper function to update user last login
function updateLastLogin($userId) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("UPDATE users SET last_login = CURRENT_TIMESTAMP WHERE id = ?");
        return $stmt->execute([$userId]);
    } catch(PDOException $e) {
        error_log("Error updating last login: " . $e->getMessage());
        return false;
    }
}
?>
