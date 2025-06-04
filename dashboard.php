<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System - Dashboard</title>
    <style>
        /* Reset styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Global styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            background-color: #000000;
            color: #fff;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
        }

        h1 {
            font-style: Gediya;
            margin-bottom: 30px;
            font-size: em;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Text shadow for emphasis */
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            grid-gap: 20px;
            text-align: left;
        }

        .card {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            color: #fff;
            transition: transform 0.3s, box-shadow 0.3s; /* Add transition for smoother effects */
            background-color: rgba(255, 255, 255, 0.2); /* Light and translucent */
            border: 2px solid transparent; /* Add transparent border */
        }

        .card h2 {
            font-size: 1.5em;
            margin-bottom: 10px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5); /* Text shadow for emphasis */
        }

        .card p {
            font-size: 1.1em;
        }

        /* Button colors */
        .btn-yellow {
            background-color: rgba(255, 215, 0, 0.7); /* Light yellow */
        }

        .btn-orange {
            background-color: rgba(255, 165, 0, 0.7); /* Orange */
        }

        .btn-blue {
            background-color: rgba(30, 144, 255, 0.7); /* Blue */
        }

        .btn-purple {
            background-color: rgba(128, 0, 128, 0.7); /* Purple */
        }

        .btn-green {
            background-color: rgba(0, 128, 0, 0.7); /* Green */
        }

        .btn-red{
            background-color: rgba(255, 0, 0, 0.7);
        }



        /* Button hover effect */
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5); /* Increase shadow on hover */
            border-color: rgba(255, 255, 255, 0.5); /* Change border color on hover */
        }

        /* Anchor styles */
        .btn-link {
            text-decoration: none;
            color: inherit; /* Inherit text color from parent */
        }

        
    </style>
</head>
<body>
    <div class="container">
        <h1>Dashboard</h1>
        <div class="dashboard-grid">
            <!-- Student Management -->
            <a href="stu.php" class="btn-link">
                <div class="card btn-yellow">
                    <h2>Student Management</h2>
                    <p>Add, view, and edit student profiles</p>
                </div>
            </a>
            <!-- Teacher Management -->
            <a href="teacher.php" class="btn-link">
                <div class="card btn-orange">
                    <h2>Teacher Management</h2>
                    <p>Add, view, and edit teacher profiles</p>
                </div>
            </a>
            <!-- Course Management -->
            <a href="fee_manage.php" class="btn-link">
                <div class="card btn-blue">
                    <h2> Fees Management</h2>
                    <p>Generate and check fee status</p>
                </div>
            </a>
            <!-- Attendance Tracking -->
            <a href="attendance.php" class="btn-link">
                <div class="card btn-purple">
                    <h2>Attendance Tracking</h2>
                    <p>Record and track student attendance</p>
                </div>
            </a>
            <!-- Reports and Analytics -->
            <a href="repo.php" class="btn-link">
                <div class="card btn-green">
                    <h2>Reports and Analytics</h2>
                    <p>Generate and view reports</p>
                </div>
            </a>
            <a href="indel.php" class="btn-link">
                <div class="card btn-red">
                    <h2>Log Out of This Session</h2>
                    <p>Log out of the system and return to homepage</p>
                </div>
            </a>
        </div>
    </div>
</body>
</html>
