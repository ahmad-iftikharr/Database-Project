<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Management</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('a.jpg');
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            margin-top: 0px;
            text-align: center;
            padding: 50px;
            background-color: rgba(69,69 , 69, 0.8); /* Translucent gray */
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .container:hover {
            transform: translateY(-10px);
        }

        h1 {
            margin-bottom: 30px;
            color:lightskyblue;
            font-size: 36px;
        }

        p {
            margin-bottom: 20px;
            color:black;
            font-size: 18px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }

        .learn-more {
            padding: 15px 30px;
            border: none;
            background-color: #ff6f61;
            color: #fff;
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .learn-more:hover {
            background-color: #f63f36;
        }

        .learn-more:focus {
            outline: none;
        }

        .learn-more:active {
            transform: translateY(2px);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Attendance Manager</h1>
        <p>Select an option:</p>
        <div class="button-container">
            <button class="learn-more" onclick="checkFeeStatus()">Record-Attendance</button>
            <button class="learn-more" onclick="generateFeeBill()">Track-Attendance</button>
        </div>
    </div>

    <script>
        function checkFeeStatus() {
            // Redirect to the fee status page
            window.location.href = "r_attend.php";
        }

        function generateFeeBill() {
            // Redirect to the generate fee bill page
            window.location.href = "t_attend.php";
        }
    </script>
</body>
</html>



