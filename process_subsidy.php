<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'government') {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit();
}

require_once 'government_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subsidyId = $_POST['subsidy_id'] ?? null;
    $status = $_POST['status'] ?? null;

    if (!$subsidyId || !$status) {
        echo json_encode(['success' => false, 'message' => 'Missing required parameters']);
        exit();
    }

    if (!in_array($status, ['approved', 'rejected'])) {
        echo json_encode(['success' => false, 'message' => 'Invalid status']);
        exit();
    }

    $result = processSubsidy($subsidyId, $status, $_SESSION['username']);

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to process subsidy']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?> 