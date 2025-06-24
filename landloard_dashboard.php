<?php
// Start session to check if landlord is logged in
session_start();
if (!isset($_SESSION['landlord_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landlord Dashboard</title>
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
        .add-hostel {
            margin-top: 30px;
            background-color: #ecf0f1;
            padding: 20px;
            border-radius: 10px;
        }
        .add-hostel h2 {
            margin-top: 0;
        }
        .add-hostel form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .add-hostel input[type="text"],
        .add-hostel input[type="number"],
        .add-hostel input[type="file"] {
            padding: 10px;
            border: 1px solid #bdc3c7;
            border-radius: 5px;
        }
        .add-hostel input[type="submit"] {
            padding: 10px;
            background-color: #1abc9c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .add-hostel input[type="submit"]:hover {
            background-color: #16a085;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Landlord</h2>
        <a href="#" onclick="loadPage('dashboard')">Dashboard</a>
        <a href="#" onclick="loadPage('add-hostel')">Add Hostel</a>
        <a href="#" onclick="loadPage('my-hostels')">My Hostels</a>
        <a href="#" onclick="loadPage('bookings')">Bookings</a>
        <a href="#" onclick="loadPage('messages')">Messages</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <h1>Welcome, Landlord</h1>
        <div class="dashboard-stats">
            <div class="stat-card">
                <h3>Total Hostels</h3>
                <p>5</p>
            </div>
            <div class="stat-card">
                <h3>Pending Bookings</h3>
                <p>3</p>
            </div>
            <div class="stat-card">
                <h3>Messages</h3>
                <p>2</p>
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
                    content = '<h2>Dashboard Overview</h2><p>Summary of your hostels and activities.</p>';
                    break;
                case 'add-hostel':
                    content = `
                        <div class="add-hostel">
                            <h2>Add New Hostel</h2>
                            <form id="add-hostel-form" onsubmit="handleFormSubmit(event)">
                                <label for="hostel-name">Hostel Name:</label>
                                <input type="text" id="hostel-name" name="hostel_name" required>
                                <label for="location">Location:</label>
                                <input type="text" id="location" name="location" required>
                                <label for="price">Price per Room:</label>
                                <input type="number" id="price" name="price" required>
                                <label for="image">Upload Image:</label>
                                <input type="file" id="image" name="image" accept="image/*" required>
                                <input type="submit" value="Submit">
                            </form>
                        </div>
                    `;
                    break;
                case 'my-hostels':
                    content = '<h2>My Hostels</h2><p>List of all your hostels.</p>';
                    break;
                case 'bookings':
                    content = '<h2>Bookings</h2><p>View and manage your bookings.</p>';
                    break;
                case 'messages':
                    content = '<h2>Messages</h2><p>View and respond to messages.</p>';
                    break;
                default:
                    content = '<p>Page not found.</p>';
            }

            contentDiv.innerHTML = content;
        }

        function handleFormSubmit(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);

            // Placeholder for form submission (e.g., AJAX to server)
            console.log('Form Data:', {
                hostel_name: formData.get('hostel_name'),
                location: formData.get('location'),
                price: formData.get('price'),
                image: formData.get('image').name
            });

            alert('Hostel added successfully! (Placeholder response)');
            form.reset();
        }

        // Load dashboard by default
        window.onload = () => loadPage('dashboard');
    </script>
</body>
</html>