<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submit Room</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0fdf4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 60px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 128, 0, 0.15);
        }
        h2 {
            text-align: center;
            color: #14532d;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 15px;
            color: #14532d;
        }
        input[type="text"],
        input[type="number"],
        input[type="file"] {
            padding: 10px;
            margin-top: 5px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }
        .btn {
            background-color: #27ae60;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            margin-top: 20px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #1f8e4d;
        }
    </style>
</head>
<body>

<div class="container">
    <h2> Submit Your Room</h2>
    <form action="submit_crop_action.php" method="POST" enctype="multipart/form-data">
        <label for="crop_name">typ of room</label>
        <input type="text" name="crop_name" id="crop_name" required>

         <label for="crop_name">typ of room</label>
        <input type="text" name="crop_name" id="crop_name" required>

         <label for="crop_name">typ of room</label>
        <input type="text" name="crop_name" id="crop_name" required>

        <label for="quantity">amout </label>
        <input type="number" name="quantity" id="quantity" required min="1">

        <label for="image">Upload Image (optional)</label>
        <input type="file" name="image" id="image" accept="image/*">

        <button type="submit" class="btn">Submit room</button>
    </form>
</div>

</body>
</html>