<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Started - School Management System</title>
    <style>
        /* Reset styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            font-size: 24px; /* Increase font size */
        }

        .container {
            width :100vw;
            height: 100vh; /* Fill entire screen height */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #CF9FFF;
            border-radius: 0; /* Remove border radius */
            box-shadow: none; /* Remove box shadow */
        }

        h1 {
            margin-bottom: 30px;
            font-size: 3em; /* Increase heading font size */
        }

        .btn {
            display: inline-block;
            padding: 15px 30px; /* Increase button padding */
            margin: 20px 10px; /* Increase button margin */
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 8px; /* Increase button border radius */
            transition: background-color 0.3s;
            font-size: 1.2em; /* Increase button font size */
        }

        .btn:hover {
            background-color: #4CAF50;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Get Started</h1>
        <p>Press login if already a user or press sign up for a new experience</p>
        <a href="login.php" class="btn">Login</a>
        <a href="signup.php" class="btn">Sign Up</a>
    </div>
</body>
</html>
