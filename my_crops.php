<?php
session_start();
include 'db_connection.php'; // Ensure this connects to the kilimotz DB

// Check if farmer is logged in
if (!isset($_SESSION['farmer_id'])) {
    die("❌ Unauthorized access. Please log in.");
}

$farmer_id = $_SESSION['farmer_id'];

// Fetch all crops submitted by the logged-in farmer
$sql = "SELECT crop_name, quantity, image, submitted_at FROM crops WHERE farmer_id = ? ORDER BY submitted_at DESC";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $farmer_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Submitted Crops</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            max-width: 900px;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #28a745;
            color: white;
        }
        img.thumb {
            max-width: 100px;
            border-radius: 5px;
        }
        .btn {
            display: inline-block;
            margin: 10px auto;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
        .container {
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>📋 My Submitted Crops</h2>
    <a href="farmer_dashboard.php" class="btn">⬅ Back to Dashboard</a>
</div>

<?php
if (mysqli_num_rows($result) > 0) {
    echo "<table>
            <tr>
                <th>Crop Name</th>
                <th>Quantity</th>
                <th>Image</th>
                <th>Submitted At</th>
            </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>" . htmlspecialchars($row['crop_name']) . "</td>
                <td>" . (int)$row['quantity'] . " sacks</td>
                <td>";
        if (!empty($row['image'])) {
            echo "<img class='thumb' src='" . htmlspecialchars($row['image']) . "' alt='Crop Image'>";
        } else {
            echo "No image";
        }
        echo "</td>
                <td>" . date("d M Y, h:i A", strtotime($row['submitted_at'])) . "</td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align:center;'>No crops submitted yet.</p>";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>

</body>
</html>
