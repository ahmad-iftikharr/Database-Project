<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Teacher - Teacher Management</title>
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
    <h1>Remove Teacher</h1>
    <form action="remove_teacher.php" method="post">
        <label for="teacher_id">Teacher ID:</label>
        <input type="text" id="teacher_id" name="teacher_id" placeholder="Enter teacher's ID to remove" required>

        <label for="teacher_name">Teacher Name:</label>
        <input type="text" id="teacher_name" name="teacher_name" placeholder="Enter teacher's name to confirm" required>

        <input type="submit" value="Remove Teacher">
    </form>
</body>
<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if student ID and name are provided
    if (!empty($_POST["teacher_id"]) && !empty($_POST["teacher_name"])) {
        // Store student ID and name in variables
        $teacher_id = $_POST["teacher_id"];
        $teacher_name = $_POST["teacher_name"];

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
        $sql = "SELECT * FROM teacher WHERE TeacherID = ? AND Name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $teacher_id, $teacher_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // If student ID and name match, proceed to delete
            $sql_delete = "DELETE FROM teacher WHERE TeacherID = ?";
            $stmt_delete = $conn->prepare($sql_delete);
            $stmt_delete->bind_param("i", $teacher_id);
            if ($stmt_delete->execute()) {
                // Close statement and connection
                $stmt_delete->close();
                $conn->close();

                $message = "Teacher removed successfully.";
                echo "<div class='message-box'>$message</div>";
            } else {
                echo "Error: " . $stmt_delete->error;
            }
        } else {
            $message = "Teacher ID and name do not match. Please re-enter.";
            echo "<div class='message-box error'>$message</div>";
        }
    } else {
        // Display an error message if student ID or name is empty
    }
}
?>

<script>
    // Function to hide the message box after a specified delay
function hideMessageBox() {
    var messageBox = document.querySelector('.message-box');
    setTimeout(function() {
        messageBox.style.opacity = '0'; // Set opacity to 0 after 5 seconds
        setTimeout(function() {
            messageBox.remove(); // Remove the message box from the DOM after transition
        }, 500);
    }, 5000); // 5 seconds delay
}

// Call the function to hide the message box
hideMessageBox();

</script>