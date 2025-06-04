<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <style>
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
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="grade">Grade:</label>
        <input type="text" name="grade" id="grade" required>
        <label for="subject">Subject:</label>
        <input type="text" name="subject" id="subject" required>
        <input type="submit" value="submit">
    </form>

    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if grade and subject are provided
        if (!empty($_POST["grade"]) && !empty($_POST["subject"])) {
            // Store grade and subject in variables
            $grade = $_POST["grade"];
            $subject = $_POST["subject"];

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

            // Query to get average attendance and average grade
            $sql = "SELECT  AvgAttendance,AvgGrade FROM report WHERE Class = ? AND Subject = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $grade, $subject);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // If records found, display average attendance and grade
                $row = $result->fetch_assoc();
                echo "<div class='message-box success'>";
                echo "<p>Average Attendance: " . $row["AvgAttendance"] . "</p>";
                echo "<p>Average Grade: " . $row["AvgGrade"] . "</p>";
                echo "</div>";
            } else {
                $message = "No records found for the provided grade and subject.";
                echo "<div class='message-box error'>$message</div>";
            }

            // Close statement and connection
            $stmt->close();
            $conn->close();
        } else {
            // Display an error message if grade or subject is empty
            $message = "Please enter both grade and subject.";
            echo "<div class='message-box error'>$message</div>";
        }
    }
    ?>
</body>
</html>
