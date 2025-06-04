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

</head>
<body>
    <h1>Add Teacher</h1>
    <form action="add_teacher.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" placeholder="Enter teacher's name" required>

        <label for="gender">Gender:</label>
        <input type="text" id="gender" name="gender" placeholder="Enter teacher's gender" required>

        <label for="class">Class:</label>
        <input type="text" id="class" name="class" placeholder="Enter teacher's class" required>

        <label for="Phone"> Phone:</label>
        <input type="text" id="Phone" name="Phone" placeholder="Enter teacher's phone number" required>

        <label for="Subject"> Subject:</label>
        <input type="text" id="Subject" name="Subject" placeholder="Enter teacher's subject" required>



        <input type="submit" value="Add teacher">
    </form>
</body>
</html>

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all form fields are provided
    if (!empty($_POST["name"]) && !empty($_POST["gender"]) && !empty($_POST["class"]) && !empty($_POST["Phone"])&& !empty($_POST["Subject"])) {
        // Store form data in variables
        $name = $_POST["name"];
        $gender = $_POST["gender"];
        $class = $_POST["class"];
        $phone = $_POST["Phone"]; // Corrected field name to "Phone"
        $subject=$_POST["Subject"]; // Corrected field name to "Subject"

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
        $sql = "INSERT INTO teacher (name, gender, class, phone,subject) VALUES (?, ?, ?, ?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $name, $gender, $class, $phone,$subject); // Changed "ssss" to "sssss" for the bind_param function

        // Execute the SQL statement
        if ($stmt->execute()) {
            // Close statement and connection
            $stmt->close();
            $conn->close();

            // Redirect the user to a success page
            header("Location: add_teacher_success.php");
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
