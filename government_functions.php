<?php
require_once 'db.php';

// Function to get market statistics
function getMarketStatistics() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT * FROM market_statistics ORDER BY last_updated DESC LIMIT 1");
        return $stmt->fetch();
    } catch(PDOException $e) {
        error_log("Error fetching market statistics: " . $e->getMessage());
        return false;
    }
}

// Function to get all policies
function getPolicies() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT * FROM policies ORDER BY created_at DESC");
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        error_log("Error fetching policies: " . $e->getMessage());
        return false;
    }
}

// Function to update policy status
function updatePolicyStatus($policyId, $status) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("UPDATE policies SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $policyId]);
    } catch(PDOException $e) {
        error_log("Error updating policy status: " . $e->getMessage());
        return false;
    }
}

// Function to get pending subsidy applications
function getPendingSubsidies() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT * FROM subsidy_applications WHERE status = 'pending' ORDER BY application_date DESC");
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        error_log("Error fetching pending subsidies: " . $e->getMessage());
        return false;
    }
}

// Function to process subsidy application
function processSubsidy($subsidyId, $status, $processedBy, $notes = '') {
    global $pdo;
    try {
        $stmt = $pdo->prepare("UPDATE subsidy_applications 
                              SET status = ?, processed_date = CURRENT_TIMESTAMP, 
                                  processed_by = ?, notes = ? 
                              WHERE id = ?");
        return $stmt->execute([$status, $processedBy, $notes, $subsidyId]);
    } catch(PDOException $e) {
        error_log("Error processing subsidy: " . $e->getMessage());
        return false;
    }
}

// Function to get reports
function getReports($type = null) {
    global $pdo;
    try {
        if ($type) {
            $stmt = $pdo->prepare("SELECT * FROM reports WHERE report_type = ? ORDER BY created_at DESC");
            $stmt->execute([$type]);
        } else {
            $stmt = $pdo->query("SELECT * FROM reports ORDER BY created_at DESC");
        }
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        error_log("Error fetching reports: " . $e->getMessage());
        return false;
    }
}

// Function to create new report
function createReport($title, $description, $reportType, $createdBy, $filePath = null) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("INSERT INTO reports (title, description, report_type, created_by, file_path) 
                              VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$title, $description, $reportType, $createdBy, $filePath]);
    } catch(PDOException $e) {
        error_log("Error creating report: " . $e->getMessage());
        return false;
    }
}

// Function to update market statistics
function updateMarketStatistics($totalFarmers, $activeTraders, $monthlyTransactions) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("INSERT INTO market_statistics (total_farmers, active_traders, monthly_transactions) 
                              VALUES (?, ?, ?)");
        return $stmt->execute([$totalFarmers, $activeTraders, $monthlyTransactions]);
    } catch(PDOException $e) {
        error_log("Error updating market statistics: " . $e->getMessage());
        return false;
    }
}
?> 