<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Register</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(#c9d6ff, #e2e2e2);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .container {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      width: 400px;
    }

    h2 {
      text-align: center;
      color: #333;
    }

    label {
      font-weight: bold;
      display: block;
      margin: 10px 0 5px;
    }
input{
      width: 100%;
      padding: 10px;
      border-radius: 6px;
      margin-top: 10px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    button {
      width: 48%;
      padding: 10px;
      background: #4CAF50;
      color: white;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
    }

    button:hover {
      background: #45a049;
    }

    .button-group {
      display: flex;
      justify-content: space-between;
      margin-top: 15px;
    }

    .link {
      text-align: center;
      margin-top: 15px;
    }

    .link a {
      color: #4CAF50;
      text-decoration: none;
    }

    .link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Please fill in this form to create an account</h2>
    <form action="backend/register_handling.php" method="POST">
      <input type="text" id="firstName" placeholder="full Name" name="fName" required>
      <input type="email" id="email" name="email" placeholder="email" required>

      <input type="tel" id="phone" name="phone" placeholder="phone number">

      <input type="password" id="password" placeholder="password" name="password" required>

      
      <input type="password" id="confirmPassword"placeholder="confirm_password" name="confirmPassword" required>

         <div class="button-group">
        <button type="submit">Register</button>
        <button type="button" onclick="resetForm()" style="background: #f44336;">Cancel</button>
      </div>
       <div class="link">
      Already have an account? <a href="login.php">Sign In</a>
    </div>
  </div>
      </div>
    </form>
</body>
</html>