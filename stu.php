<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
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
            background-color: #000;
            color: #fff;
            text-align: center;
            padding: 20px;
            overflow: hidden; /* Hide overflow to prevent horizontal scrollbar */
            background-image: url('hu.jpg'); /* Set background image */
            background-size: cover; /* Cover the entire viewport */
            background-position: center; /* Center the background image */
        }

        h1 {
            margin-bottom: 20px;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh; /* Set container height to viewport height */
            overflow: hidden; /* Hide overflow to prevent vertical scrollbar */
        }

        .options {
            display: flex;
            flex-wrap: wrap; /* Allow options to wrap to the next row */
            justify-content: space-evenly; /* Evenly space options within rows */
            gap: 20px;
            padding: 0 20px; /* Add padding to create space around options */
            width: 100%;
            animation: slide-in 0.5s forwards; /* Slide in animation */
        }

        .option-box {
            flex-basis: calc(33.333% - 20px); /* Set initial width of option boxes */
            background-color: #333;
            color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
            transition: transform 0.5s ease-in-out; /* Add transition for sliding effect */
            cursor: pointer;
            overflow: hidden; /* Hide overflow to prevent box-shadow from being visible outside the box */
        }

        .option-box:nth-child(1) {
            background-color:darkred;
            color: #fff;
            order: -1; /* Change the order of the first box to appear at the top */
        }

        .option-box:nth-child(2) {
            background-color: blue;
        }

        .option-box:nth-child(3) {
            background-color: green;
        }

        .option-box:nth-child(4) {
            background-color: #2196F3;
            order: -1; /* Change the order of the fourth box to appear at the bottom */
        }

        /* Animation for sliding in */
        @keyframes slide-in {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <h1>Student Management</h1>
    <div class="container">
        <div class="options">
            <div class="option-box" onclick="window.location.href='add_student.php'">
                <h2>Add Student</h2>
                <p>Add a new student to the database</p>
            </div>
            <div class="option-box" onclick="window.location.href='remove_student.php'">
                <h2>Remove Student</h2>
                <p>Remove an existing student from the database</p>
            </div>
            <div class="option-box" onclick="window.location.href='view_students.php'">
                <h2>View Students</h2>
                <p>View all students currently in the database</p>
            </div>
        </div>
    </div>
</body>
</html>
