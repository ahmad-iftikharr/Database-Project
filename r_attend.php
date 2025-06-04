<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Attendance - Student Management</title>
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

        input[type="text"], input[type="date"], select {
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
            padding: 12px 24px;
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
        
        
    </style>
</head>
<body>
    <h1>Add Attendance</h1>
    <form action="r_attend.php" method="post">
        <label for="studentid">Student ID:</label>
        <input type="text" id="studentid" name="studentid" placeholder="Enter student ID" required>

        <label for="attendance_status">Attendance Status:</label>
        <select id="attendance" name="attendance" required>
            <option value="Present">Present</option>
            <option value="Absent">Absent</option>
        </select>

        <label for="a_status">A-Status:</label>
        <select id="a_status" name="a_status" required>
            <option value="Normal">Normal</option>
            <option value="Warning">Warning</option>
        </select>

        <label for="attendance_date">Attendance Date:</label>
        <input type="date" id="attendance_date" name="attendance_date" required>

        <input type="submit" value="Add Attendance">
    </form>
</body>
</html>
<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all form fields are provided
    if (!empty($_POST["studentid"]) && !empty($_POST["attendance"]) && !empty($_POST["a_status"]) && !empty($_POST["attendance_date"])) {
        // Store form data in variables
        $student_id = $_POST["studentid"];
        $attendance_status = $_POST["attendance"];
        $a_status = $_POST["a_status"];
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

        // Prepare SQL statement to insert data into the attendance table
        $sql = "INSERT INTO attendance (studentid, attendance, a_status, attendance_date) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $student_id, $attendance_status, $a_status, $attendance_date);

        // Execute the SQL statement
        if ($stmt->execute()) {
            // Close statement and connection
            $stmt->close();
            $conn->close();

            // Redirect the user to a success page
            header("Location: add_attendance_success.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        // Display an error message if any form field is empty
        echo "Please fill out all the fields.";
    }
}
?>
