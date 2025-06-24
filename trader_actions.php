<?php
// session_start();
// if (!isset($_SESSION['trader_id'])) {
//     header("Location: login.php");
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>USE Dashboard - Smart room rent platform</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #f0fdf4;
        }

        .sidebar {
            width: 240px;
            background-color: #14532d;
            color: #ecf0f1;
            padding: 20px;
            flex-shrink: 0;
            height: 100vh;
            position: fixed;
        }

        .logo {
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 40px;
            color: #2ecc71;
        }

        .nav {
            list-style: none;
        }

        .nav li {
            margin: 15px 0;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .nav li a {
            color: #ecf0f1;
            text-decoration: none;
            font-size: 16px;
            display: block;
        }

        .nav li.active,
        .nav li:hover {
            background-color: #1e824c;
        }

        .main-content {
            margin-left: 260px;
            padding: 40px;
            width: 100%;
        }

        .main-content h1 {
            font-size: 30px;
            margin-bottom: 30px;
            color: #14532d;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
        }

        .card {
            background-color: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 128, 0, 0.1);
            text-align: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 15px rgba(0, 128, 0, 0.15);
        }

        .card h3 {
            color: #1e4620;
            margin-bottom: 10px;
            font-size: 20px;
        }

        .card p {
            color: #555;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .btn {
            background-color: #27ae60;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #219150;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">📦 <strong>smart room</strong>TZ</div>
        <ul class="nav">
            <li class="active">📊 Dashboard</li>
            <li><a href="view_crops.php"> View Available room</a></li>
            <li><a href="send_requests.php">📩 Send Requests</a></li>
            <li><a href="send_message.php">💬 Send Message</a></li>
            <li><a href="logout.php">🔓 Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <h1>Welcome user </h1>
        <div class="cards">
            <div class="card">
                <h3> View Available room</h3>
                <p>See all room updated by lanloard.</p>
                <a href="view_crops.php" class="btn">View room</a>
            </div>
            <div class="card">
                <h3>📩 Send Requests</h3>
                <p>Request to buy room from landloard.</p>
                <a href="send_requests.php" class="btn">Send Request</a>
            </div>
            <div class="card">
                <h3>💬 Send Message</h3>
                <p>Communicate with landloard or adminstrator.</p>
                <a href="send_message.php" class="btn">Send Message</a>
            </div>
        </div>
    </div>
</body>
</html>
