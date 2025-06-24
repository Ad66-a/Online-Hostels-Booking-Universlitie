<?php
// Start session to check if admin is logged in
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            height: 100vh;
            padding: 20px;
            position: fixed;
        }
        .sidebar h2 {
            color: white;
            text-align: center;
        }
        .sidebar a {
            display: block;
            color: white;
            padding: 10px;
            text-decoration: none;
            margin: 5px 0;
            border-radius: 5px;
            background-color: #34495e;
            text-align: center;
            cursor: pointer;
        }
        .sidebar a:hover {
            background-color: #1abc9c;
        }
        .content {
            margin-left: 270px;
            padding: 20px;
            width: calc(100% - 270px);
        }
        .dashboard-stats {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }
        .stat-card {
            background-color: #ecf0f1;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            flex: 1;
        }
        .stat-card h3 {
            margin: 0;
            color: #7f8c8d;
        }
        .stat-card p {
            font-size: 24px;
            color: #2c3e50;
            margin: 10px 0 0;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin</h2>
        <a href="#" onclick="loadPage('dashboard')">Dashboard</a>
        <a href="#" onclick="loadPage('users')">Manage Users</a>
        <a href="#" onclick="loadPage('landlords')">Manage Landlords</a>
        <a href="#" onclick="loadPage('hostels')">Hostel Listings</a>
        <a href="#" onclick="loadPage('bookings')">Bookings</a>
        <a href="#" onclick="loadPage('messages')">Messages</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <h1>Welcome to Admin Dashboard</h1>
        <div class="dashboard-stats">
            <div class="stat-card">
                <h3>Total Users</h3>
                <p>120</p>
            </div>
            <div class="stat-card">
                <h3>Landlords</h3>
                <p>45</p>
            </div>
            <div class="stat-card">
                <h3>Hostels</h3>
                <p>320</p>
            </div>
        </div>
        <div id="page-content">
            <!-- Dynamic content will load here -->
        </div>
    </div>

    <script>
        function loadPage(page) {
            const contentDiv = document.getElementById('page-content');
            let content = '';

            switch (page) {
                case 'dashboard':
                    content = '<h2>Dashboard Overview</h2><p>Summary of all activities.</p>';
                    break;
                case 'users':
                    content = '<h2>Manage Users</h2><p>List and manage all registered users.</p>';
                    break;
                case 'landlords':
                    content = '<h2>Manage Landlords</h2><p>View and manage landlord profiles.</p>';
                    break;
                case 'hostels':
                    content = '<h2>Hostel Listings</h2><p>Browse and manage hostel listings.</p>';
                    break;
                case 'bookings':
                    content = '<h2>Bookings</h2><p>View and manage all bookings.</p>';
                    break;
                case 'messages':
                    content = '<h2>Messages</h2><p>View and respond to messages.</p>';
                    break;
                default:
                    content = '<p>Page not found.</p>';
            }

            contentDiv.innerHTML = content;
        }

        // Load dashboard by default
        window.onload = () => loadPage('dashboard');
    </script>
</body>
</html>