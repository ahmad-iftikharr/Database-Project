<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student - Student Management</title>
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
    </style>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Back to Dashboard Button</title>
  <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS file -->
</head>
<body>
  <a href="dashboard.php" class="back-to-dashboard">Back to Dashboard</a>
</body>
</html>

  
</body>
</html>
<body>
    <h1>Add Student</h1>
    <form action="add_student.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" placeholder="Enter student's name" required>

        <label for="gender">Gender:</label>
        <input type="text" id="gender" name="gender" placeholder="Enter student's gender" required>

        <label for="class">Class:</label>
        <input type="text" id="class" name="class" placeholder="Enter student's class" required>

        <label for="guardianphone">Guardian Phone:</label>
        <input type="text" id="guardianphone" name="guardianphone" placeholder="Enter guardian's phone number" required>

        <input type="submit" value="Add Student">
    </form>
</body>
</html>

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all form fields are provided
    if (!empty($_POST["name"]) && !empty($_POST["gender"]) && !empty($_POST["class"]) && !empty($_POST["guardianphone"])) {
        // Store form data in variables
        $name = $_POST["name"];
        $gender = $_POST["gender"];
        $class = $_POST["class"];
        $guardianphone = $_POST["guardianphone"];

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

        // Prepare SQL statement to insert data into the student table
        $sql = "INSERT INTO student (name, gender, class, guardianphone) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $gender, $class, $guardianphone);

        // Execute the SQL statement
        if ($stmt->execute()) {
            // Close statement and connection
            $stmt->close();
            $conn->close();

            // Redirect the user to a success page
            header("Location: add_student_success.php");
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
