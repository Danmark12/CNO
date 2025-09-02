<?php
// index.php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CNO NutriMap - Welcome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #0d47a1, #1976d2);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }
        .container img {
            width: 100px;
            margin-bottom: 20px;
        }
        h1 {
            margin-bottom: 10px;
            font-size: 2em;
        }
        p {
            font-size: 1em;
            margin-bottom: 30px;
        }
        a.button {
            display: inline-block;
            background: #ffcc00;
            color: #000;
            padding: 12px 25px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }
        a.button:hover {
            background: #ffc107;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="resources/city_logo.png" alt="CNO Logo">
        <h1>Welcome to CNO NutriMap</h1>
        <p>City Nutrition Office System for Health and Nutrition Data<br>
        Managed by Admin and Barangay Nutrition Scholars</p>
        <a href="login.php" class="button">Go to Login</a>
    </div>
</body>
</html>
