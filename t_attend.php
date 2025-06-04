<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Attendance - Student Management</title>
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
        }

        h1 {
            margin-bottom: 20px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"], input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
            outline: none;
        }
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #4e8cff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            transition: background-color 0.3s;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #2a5db0;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            color-scheme: red;
        }

        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: red;
            color: black;
        }

        tr:nth-child(even) {
            background-color: #333;
        }

        tr:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <h1>View Attendance</h1>
    <form action="" method="post">
        <label for="studentid">Student ID:</label>
        <input type="text" id="studentid" name="studentid" placeholder="Enter student ID" required>

        <label for="attendance_date">Attendance Date:</label>
        <input type="date" id="attendance_date" name="attendance_date" required>

        <input type="submit" value="View Attendance"><br>
    </form>

    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if student ID and attendance date are provided
        if (!empty($_POST["studentid"]) && !empty($_POST["attendance_date"])) {
            // Store form data in variables
            $student_id = $_POST["studentid"];
            $attendance_date = $_POST["attendance_date"];

            // Database connection parameters
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "proj";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare SQL statement to fetch attendance data
            $sql = "SELECT * FROM attendance WHERE studentid = ? AND attendance_date = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $student_id, $attendance_date);

            // Execute the SQL statement
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if any attendance data is found
            if ($result->num_rows > 0) {
                echo "<h2><br>Attendance for Student ID: $student_id on $attendance_date</h2>";
                echo "<table>";
                echo "<tr><th>Attendance Status</th><th>A-Status</th></tr>";
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["attendance"] . "</td><td>" . $row["a_status"] . "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No attendance data found for Student ID: $student_id on $attendance_date</p>";
            }

            // Close statement and connection
            $stmt->close();
            $conn->close();
        } else {
            echo "<p>Please provide both Student ID and Attendance Date.</p>";
        }
    }
    ?>
</body>
</html>
