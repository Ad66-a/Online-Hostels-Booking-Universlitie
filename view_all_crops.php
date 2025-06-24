<?php
session_start();

// Restrict access to government role
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'government') {
    echo "⛔ Access denied.";
    exit();
}

// DB connection (update values as needed)
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "kilimoTz";
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch crops
$sql = "SELECT * FROM crops ORDER BY submission_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Submitted Crops - KilimoTZ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            background-color: #f0fdf4;
        }
        h1 {
            color: #14532d;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0,128,0,0.1);
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #14532d;
            color: white;
        }
        tr:hover {
            background-color: #e9f5ec;
        }
    </style>
</head>
<body>
    <h1>All Submitted Crops</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Farmer Name</th>
            <th>Crop Type</th>
            <th>Quantity</th>
            <th>Location</th>
            <th>Submission Date</th>
        </tr>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['farmer_name']) ?></td>
                    <td><?= htmlspecialchars($row['crop_type']) ?></td>
                    <td><?= htmlspecialchars($row['quantity']) ?></td>
                    <td><?= htmlspecialchars($row['location']) ?></td>
                    <td><?= htmlspecialchars($row['submission_date']) ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="6">No crop submissions found.</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
