<?php
session_start();
include 'db_connection.php'; // Connects to 'kilimotz' DB

// Check if farmer is logged in
if (!isset($_SESSION['farmer_id'])) {
    die("❌ Unauthorized access. Please log in.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $farmer_id = $_SESSION['farmer_id'];
    $crop_name = mysqli_real_escape_string($conn, $_POST['crop_name']);
    $quantity = (int) $_POST['quantity'];
    $image_path = "";

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $upload_dir = "uploads/";
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $image_name = basename($_FILES["image"]["name"]);
        $target_file = $upload_dir . time() . "_" . $image_name;
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($image_file_type, $allowed_types)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image_path = $target_file;
            } else {
                die("❌ Failed to upload image.");
            }
        } else {
            die("❌ Only JPG, JPEG, PNG & GIF files are allowed.");
        }
    }

    // Insert crop into DB
    $sql = "INSERT INTO crops (farmer_id, crop_name, quantity, image, submitted_at) 
            VALUES (?, ?, ?, ?, NOW())";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "isis", $farmer_id, $crop_name, $quantity, $image_path);

    if (mysqli_stmt_execute($stmt)) {
        // Fetch all submitted crops
        $history_sql = "SELECT crop_name, quantity, image, submitted_at FROM crops WHERE farmer_id = ? ORDER BY submitted_at DESC";
        $history_stmt = mysqli_prepare($conn, $history_sql);
        mysqli_stmt_bind_param($history_stmt, "i", $farmer_id);
        mysqli_stmt_execute($history_stmt);
        $result = mysqli_stmt_get_result($history_stmt);

        // ✅ HTML confirmation and history
        echo "
        <html>
        <head>
            <title>Crop Submitted and History</title>
            <style>
                body { font-family: Arial; background: #f4f4f4; padding: 20px; }
                .card {
                    background: #fff;
                    padding: 20px;
                    margin: 20px auto;
                    border-radius: 10px;
                    max-width: 600px;
                    box-shadow: 0 0 10px rgba(0,0,0,0.1);
                    text-align: center;
                }
                .card img { max-width: 100%; border-radius: 10px; margin-top: 10px; }
                .btn {
                    display: inline-block;
                    margin-top: 20px;
                    padding: 10px 20px;
                    background-color: #28a745;
                    color: white;
                    text-decoration: none;
                    border-radius: 5px;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 30px;
                    background: white;
                    box-shadow: 0 0 10px rgba(0,0,0,0.05);
                }
                th, td {
                    padding: 10px;
                    border: 1px solid #ccc;
                    text-align: center;
                }
                th {
                    background-color: #28a745;
                    color: white;
                }
                img.thumb {
                    max-width: 80px;
                    height: auto;
                    border-radius: 5px;
                }
            </style>
        </head>
        <body>
            <div class='card'>
                <h2>✅ Crop Submitted Successfully!</h2>
                <p><strong>Crop:</strong> {$crop_name}</p>
                <p><strong>Quantity:</strong> {$quantity} sacks</p>";

        if (!empty($image_path)) {
            echo "<img src='{$image_path}' alt='Crop Image'>";
        }

        echo "<a class='btn' href='farmer_dashboard.php'>Back to Dashboard</a>
            </div>";

        // Show crop history table
        echo "<h2>📋 My Submitted Crops</h2>";
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
                        <td>" . (int)$row['quantity'] . "</td>
                        <td>";
                if (!empty($row['image'])) {
                    echo "<img class='thumb' src='" . htmlspecialchars($row['image']) . "' alt='Crop'>";
                } else {
                    echo "No image";
                }
                echo "</td>
                        <td>" . date("d M Y, h:i A", strtotime($row['submitted_at'])) . "</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No crops submitted yet.</p>";
        }

        echo "</body></html>";

        mysqli_stmt_close($history_stmt);
    } else {
        echo "❌ Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo "❌ Invalid request method.";
}
?>
