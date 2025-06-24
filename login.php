<?php
session_start();
require "Backend/connect.php"?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign In</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(to right, #fddb92, #d1fdff);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .container {
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
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

    input[type="email"],
    input[type="password"],
    select {
      width: 100%;
      padding: 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    .options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 10px;
      font-size: 14px;
    }

    .options label {
      display: flex;
      align-items: center;
      font-weight: normal;
    }

    .options input {
      margin-right: 5px;
    }

    .options a {
      color: #2196F3;
      text-decoration: none;
    }

    .options a:hover {
      text-decoration: underline;
    }

    button {
      width: 100%;
      padding: 10px;
      background: #2196F3;
      color: white;
      border: none;
      border-radius: 6px;
      margin-top: 15px;
      font-weight: bold;
      cursor: pointer;
    }

    button:hover {
      background: #1976D2;
    }

    .link {
      text-align: center;
      margin-top: 15px;
    }

    .link a {
      color: #2196F3;
      text-decoration: none;
    }

    .link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Sign In to Your Account</h2>
    <form id="signInForm" action="Backend/login_handling.php" method="post">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required />

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required />

      <div class="options">
        <label>
          <input type="checkbox" id="rememberMe" />
          Remember me
        </label>
        <a href="#" onclick="forgotPassword()">Forgot password?</a>
      </div>

      <button type="submit">Sign In</button>
    </form>

    <div class="link" >
       <a href="register.php">Don't have an account ? Register</a>
    </div>
  </div>

  <!-- <script>
    document.getElementById('signInForm').addEventListener('submit', function(e) {
      e.preventDefault();

      const email = document.getElementById('email').value;
      const password = document.getElementById('password').value;
      const role = document.getElementById('role').value;

      const formData = new FormData();
      formData.append("email", email);
      formData.append("password", password);
      formData.append("role", role);

      fetch("login.php", {
        method: "POST",
        body: formData
      })
      .then(res => res.text())
      .then(data => {
        if (data.trim() === "success") {
          alert("Login successful!");
          if (role === "admin") {
            window.location.href = "admin_dashboard.html";
          } else if (role === "landlord") {
            window.location.href = "landlord_dashboard.html";
          } else {
            window.location.href = "user_dashboard.html";
          }
        } else if (data.trim() === "wrong_password") {
          alert("Incorrect password!");
        } else if (data.trim() === "user_not_found") {
          alert("User not found!");
        } else {
          alert("Something went wrong.");
        }
      });
    });

    function forgotPassword() {
      const email = document.getElementById('email').value;
      if (!email) {
        alert("Please enter your email first.");
        return;
      }
      alert("Password recovery instructions will be sent to: " + email);
    }
  </script> -->
</body>
</html>