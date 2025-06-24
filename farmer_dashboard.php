<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>landload Dashboard - smart rood rental platform</title>
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
            background-color:rgb(2, 20, 9);
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
            color:rgb(3, 16, 8);
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
            background-color:rgb(1, 10, 5);
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
            background-color:rgb(1, 10, 5);
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo"> 🏠<strong>Hostel </strong>Dashboard</div>
        <p>👨‍🌾 Landlord Panel</p>
        <ul class="nav">
            <li class="active">🏠 Dashboard</li>
            <li><a href="submit_crop.php"> Add new hostel</a></li>
            <li><a href="my_crops.php"> View Listings room</a></li>
            <li><a href="view_prices.php"> Room Prices</a></li>
            <li><a href="trader_requests.php"> user Requests</a></li>
            
           <li><a href="messages.php">💬 Messages</a></li>
            <li><a href="logout.php">🔓 Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <h1>Welcome, Landlord!!</h1>
        <div class="cards">
            <div class="card">
                <h3>Add new hostel</h3>
                <p>Add your new room for sale and get offers from user.</p>
                <a href="submit_crop.php" class="btn">Add new hostel</a>
            </div>
            <div class="card">
                <h3>View Listings room</h3>
                <p>Manage and monitor all your add room.</p>
                <a href="my_crops.php" class="btn">My Crops</a>
            </div>
            <div class="card">
                <h3> Check Room Prices</h3>
                <p>See the latest  Landlord room prices.</p>
                <a href="view_prices.php" class="btn">View Prices</a>
            </div>
            
           
       
        </div>
    </div> --!>
</body>
</html>
