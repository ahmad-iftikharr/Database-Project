<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System - Demo Theme</title>
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
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header styles */
        header {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
        }

        header h1 {
            font-size: 2.5em;
        }

        nav ul {
            list-style: none;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            display: inline-block; 
            padding: 10px 20px; /* Adjusted padding */
            background-color: #9F2B68; /* Purple color */
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            font-weight: bold; /* Make text bold */
        }

        nav ul li a:hover {
            background-color: #4CAF50; /* Change color on hover to green */
        }

        /* Hero section styles */
        .hero {
            background-image: linear-gradient(to bottom, rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('bhe.jpg');
            background-size: cover;
            color: #fff;
            padding: 100px 0;
            text-align: center;
        }

        .hero h2 {
            font-size: 4em;
            margin-bottom: 50px;
        }

        .hero p {
            font-size: 1.8em;
            margin-bottom: 50px;
        }

        .btn {
            display: inline-block;
            padding: 15px 30px;
            background-color: #9F2B68;
            color: #fff;
            text-decoration: none;
            border-radius: 50%;
            transition: background-color 1s;
            font-size: 1.2em;
        }

        .btn:hover {
            background-color: #4CAF50; 
        }

        /* Footer styles */
        footer {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        footer p {
            font-size: 0.8em;
        }


        

    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>School Management System</h1>
            <nav>
                <ul>
                    
                    <li><a href="about.php">About</a></li>
                    
                    
                </ul>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <h2>Welcome to our School Management System</h2>
            <p>A modern and intuitive platform for managing your school's activities.</p>
            <a href="gs.php" class="btn">Get Started</a>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 School Management System. All rights reserved.
                
            </p>
        </div>
    </footer>
</body>
</html>
