<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>admnistrator Dashboard </title>
    <style>
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
            background-color:rgb(1, 10, 5);
            color: #ecf0f1;
            padding: 20px;
            position: fixed;
            height: 100vh;
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
            transition: background-color 0.3s;
        }

        .nav li a {
            color: #ecf0f1;
            text-decoration: none;
            font-size: 16px;
            display: block;
        }

        .nav li:hover,
        .nav li.active {
            background-color: #1e824c;
        }

        .main-content {
            margin-left: 260px;
            padding: 40px;
            width: calc(100% - 260px);
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
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 128, 0, 0.1);
            text-align: center;
            transition: transform 0.2s;
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
        }

        .btn {
            background-color: #27ae60;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #219150;
        }

        .username {
            margin-bottom: 20px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo"> <strong>ROOM</strong>TZ</div>
        <div class="username"> </div>
        <ul class="nav">
            <li class="active">🏠 Dashboard</li>
            <li><a href="view_all_crops.php"> View All room</a></li>
            <li><a href="manage_prices.php"> Manage room Prices</a></li>
            <li><a href="approve_traders.php"> Approve user Requests</a></li>
            <li><a href="view_messages.php"> View Messages</a></li>
            <li><a href="logout.php">🔓 Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <h1>Welcome, adminstrator</h1>
        <div class="cards">
            <div class="card">
                <h3> View Submitted room</h3>
                <p>Review all room submitted by farmers.</p>
                <a href="view_all_crops.php" class="btn">View room</a>
            </div>
            <div class="card">
                <h3> Manage Prices</h3>
                <p>Update prices for different ROOM.</p>
                <a href="manage_prices.php" class="btn">Manage Prices</a>
            </div>
            <div class="card">
                <h3> Trader Requests</h3>
                <p>Review and approve user applications.</p>
                <a href="approve_traders.php" class="btn">Approve Traders</a>
            </div>
            <div class="card">
                <h3> View Messages</h3>
                <p>Read messages from landroad and tradersuser.</p>
                <a href="view_messages.php" class="btn">View Messages</a>
            </div>
        </div>
    </div>
</body>
</html>
