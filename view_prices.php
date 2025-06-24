<?php
session_start();

// Redirect to index if not logged in
if (!isset($_SESSION['trader_id']) && !isset($_SESSION['farmer_id'])) {
    header("Location: index.php");
    exit();
}

// Determine user role to set back-link
$backLink = isset($_SESSION['trader_id']) ? "trader_dashboard.php" : "farmer_dashboard.php";

// ✅ Database connection
$conn = new mysqli("localhost", "root", "", "kilimotz");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ✅ Fetch crops from the database
$sql = "SELECT farmer_name, crop_name, quantity, price, location, date_submitted FROM crops ORDER BY date_submitted DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crop Price List - KilimoTZ</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0fdf4;
            padding: 40px;
            margin-left: 260px;
        }

        h1 {
            color: #14532d;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 128, 0, 0.1);
        }

        th, td {
            padding: 14px 18px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #27ae60;
            color: white;
        }

        tr:hover {
            background-color: #e8f5e9;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
            background-color: #27ae60;
            color: #fff;
            padding: 10px 16px;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }

        .back-link:hover {
            background-color: #219150;
        }
    </style>
</head>
<body>
    <a href="<?= $backLink ?>" class="back-link">⬅ Back to Dashboard</a>
    <h1>Crop Price List</h1>
    <table>
        <tr>
            <th>Farmer Name</th>
            <th>Crop Name</th>
            <th>Quantity (kg)</th>
            <th>Price (TZS/kg)</th>
            <th>Location</th>
            <th>Date Submitted</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['farmer_name']) ?></td>
                    <td><?= htmlspecialchars($row['crop_name']) ?></td>
                    <td><?= htmlspecialchars($row['quantity']) ?></td>
                    <td><?= htmlspecialchars($row['price']) ?></td>
                    <td><?= htmlspecialchars($row['location']) ?></td>
                    <td><?= htmlspecialchars($row['date_submitted']) ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="6">No crops submitted yet.</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>
<?php $conn->close(); ?>
