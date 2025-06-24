<!DOCTYPE html>
<html>
<head>
  <title>Tenant Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="margin:0; font-family:Arial, sans-serif; background:#f5f5f5;">

  <!-- Sidebar -->
  <div style="width:200px; height:100vh; background:#34495e; color:white; position:fixed;">
    <h2 style="text-align:center; padding:20px 0; border-bottom:1px solid #444;">Student</h2>
    <a href="#" style="display:block; padding:12px 20px; color:white; text-decoration:none;">Dashboard</a>
    <a href="#" style="display:block; padding:12px 20px; color:white; text-decoration:none;">Available Hostels</a>
    <a href="#" style="display:block; padding:12px 20px; color:white; text-decoration:none;">My Bookings</a>
    <a href="#" style="display:block; padding:12px 20px; color:white; text-decoration:none;">Messages</a>
    <a href="#" style="display:block; padding:12px 20px; color:white; text-decoration:none;">Logout</a>
  </div>

  <!-- Main Content -->
  <div style="margin-left:200px; padding:20px;">
    <h1>Welcome, Tenant</h1>

    <!-- Available Hostels Section -->
    <h2 style="margin-top:30px;">Available Hostels</h2>
    <div style="display:flex; flex-wrap:wrap; gap:20px;">

      <!-- Example hostel card -->
      <div style="background:white; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.1); width:250px; padding:15px;">
        <img src="https://via.placeholder.com/230x150" style="width:100%; border-radius:8px;">
        <h3>Green View Hostel</h3>
        <p>Location: Ubungo</p>
        <p>Price: TZS 150,000</p>
        <button style="padding:8px 12px; background:#2ecc71; border:none; color:white; border-radius:5px; cursor:pointer;">Book Now</button>
      </div>

      <!-- Add more cards as needed -->

    </div>

    <!-- My Bookings Section -->
    <h2 style="margin-top:40px;">My Bookings</h2>
    <table style="width:100%; background:white; border-collapse:collapse; box-shadow:0 2px 6px rgba(0,0,0,0.1);">
      <thead>
        <tr style="background:#34495e; color:white;">
          <th style="padding:10px;">Hostel</th>
          <th style="padding:10px;">Location</th>
          <th style="padding:10px;">Date</th>
          <th style="padding:10px;">Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="padding:10px;">Green View Hostel</td>
          <td style="padding:10px;">Ubungo</td>
          <td style="padding:10px;">2025-06-10</td>
          <td style="padding:10px; color:green;">Confirmed</td>
        </tr>
        <!-- More rows as needed -->
      </tbody>
    </table>

  </div>

</body>
</html>
