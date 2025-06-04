<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fee Status - Student Management</title>
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

        input[type="text"] {
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
            background-color: #FF5733;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            transition: background-color 0.3s;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #FF8C66;
        }

        .message-box {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, 255, 0, 0.5); /* Green with 50% opacity */
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .message-box.error {
            background-color: rgba(255, 0, 0, 0.5); /* Red with 50% opacity */
        }

        .back-to-dashboard {
            position: fixed; /* Fixed position */
            top: 10px; /* Distance from top of the screen */
            left: 10px; /* Distance from left of the screen */
            padding: 10px 20px; /* Padding around the button text */
            font-size: 16px; /* Font size */
            background-color: #007bff; /* Button background color */
            color: white; /* Text color */
            border: none; /* No border */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Cursor style */
        }

        .back-to-dashboard:hover {
            background-color: #0056b3; /* Button background color on hover */
        }

        .message-box {
    width: 50%;
    margin: auto;
    margin-bottom: 60px;
    text-align: center;
    padding: 40px;
    border-radius: 10px;
    font-size: 2.4em;
}

.error {
    background-color: #ffcccc;
    color: #cc0000;
}

.success {
    background-color: #ccffcc;
    color: #006600;
}

    </style>
</head>
<body>
    <h1>Fee Status</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="student_id">Student ID:</label>
        <input type="text" id="student_id" name="student_id" placeholder="Enter student's ID" required>

        <label for="student_name">Student Name:</label>
        <input type="text" id="student_name" name="student_name" placeholder="Enter student's name to confirm" required>

        <input type="submit" value="Check Fee Status">
    </form>

    <a href="dashboard.php" class="back-to-dashboard">Back to Dashboard</a>

    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if student ID and name are provided
        if (!empty($_POST["student_id"]) && !empty($_POST["student_name"])) {
            // Store student ID and name in variables
            $student_id = $_POST["student_id"];
            $student_name = $_POST["student_name"];

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

            // Check if the provided student ID and name match
            $sql = "SELECT feeAmount, feeStatus FROM fee WHERE StudentID = ? AND student_Name = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $student_id, $student_name);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // If student ID and name match, display fee status and amount
                $row = $result->fetch_assoc();
                echo "<div class='message-box success'>";
                echo "<p>Fee Amount: " . $row["feeAmount"] . "</p>";
                echo "<p>Fee Status: " . $row["feeStatus"] . "</p>";
                echo "</div>";
            } else {
                $message = "Student ID and name do not match. Please re-enter.";
                echo "<div class='message-box error'>$message</div>";
            }

            // Close statement and connection
            $stmt->close();
            $conn->close();
        } else {
            // Display an error message if student ID or name is empty
            $message = "Please enter both student ID and name.";
            echo "<div class='message-box error'>$message</div>";
        }
    }
?>
