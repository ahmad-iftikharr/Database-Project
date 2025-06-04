<?php
// Database connection parameters
$host = "localhost"; // Change this to your database host if it's different
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password if you have one
$database = "proj"; // Change this to your database name

// Initialize variables for form input
$usernameInput = $emailInput = $passwordInput = "";
$usernameErr = $emailErr = $passwordErr = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else {
        $usernameInput = test_input($_POST["username"]);
        // Check if username contains only letters and numbers
        if (!preg_match("/^[a-zA-Z0-9]*$/", $usernameInput)) {
            $usernameErr = "Only letters and numbers are allowed";
        }
    }

    // Validate email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $emailInput = test_input($_POST["email"]);
        // Check if email is valid
        if (!filter_var($emailInput, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    // Validate password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $passwordInput = test_input($_POST["password"]);
        // Additional password validation can be added here if needed
    }

    // If all fields are valid, insert data into the database
    if (empty($usernameErr) && empty($emailErr) && empty($passwordErr)) {
        // Create connection
        $conn = new mysqli($host, $username, $password, $database);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Hash the password before storing it in the database
        $hashedPassword = password_hash($passwordInput, PASSWORD_DEFAULT);

        // Prepare SQL statement to insert user data into the database
        $stmt = $conn->prepare("INSERT INTO Users (Username, Email, PasswordHash) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $usernameInput, $emailInput, $hashedPassword);

        // Execute the statement
        if ($stmt->execute()) {
            // Display a success message
            echo '<p style="color: #4e8cff;">User created successfully!</p>';
            $_SESSION["signup_success"] = true;
        } else {
            echo "Error: " . $stmt->error;
        }
        
        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
}

// Function to sanitize and validate input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - School Management System</title>
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
            line-height: 1.6;
            background-color: #000; /* Set background color to black */
            color: #fff; /* Set text color to white */
            text-align: center;
        }

        .container {
            max-width: 600px; /* Increase max-width for a bigger box */
            margin: 50px auto;
            padding: 40px; /* Increase padding for more space inside the box */
            background-color: rgba(20, 20, 20, 0.8); /* Set box background color to translucent black */
            border-radius: 20px; /* Adjust border-radius for rounded corners */
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5); /* Adjust box shadow */
        }

        h2 {
            margin-bottom: 20px;
        }

        input {
            width: calc(100% - 20px); /* Adjust input width to accommodate padding */
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: rgba(255, 255, 255, 0.1); /* Light greyish background */
            color: #fff; /* Set text color to white */
            outline: none; /* Remove input outline */
        }

        .btn {
            display: inline-block;
            padding: 12px 24px; /* Increase button padding */
            background-color: #4e8cff; /* Light bluish background color */
            color: #fff; /* Set text color to white */
            text-decoration: none;
            border-radius: 5px;
            border: none; /* Remove button border */
            transition: background-color 0.3s;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #2a5db0; /* Darker shade of bluish color on hover */
        }

        .error {
            color: #ff0000; /* Set color to red for error messages */
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Sign Up</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="username" placeholder="Username" value="<?php echo $usernameInput; ?>" required>
            <span class="error"><?php echo $usernameErr; ?></span> <!-- Display username error message -->
            <input type="email" name="email" placeholder="Email" value="<?php echo $emailInput; ?>" required>
            <span class="error"><?php echo $emailErr; ?></span> <!-- Display email error message -->
            <input type="password" name="password" placeholder="Password" required>
            <span class="error"><?php echo $passwordErr; ?></span> <!-- Display password error message -->
            <button type="submit" class="btn">Sign Up</button>
        </form>
    </div>
</body>
<script>
        // Wait for 3 seconds before redirecting to login page
        setTimeout(function() {
            window.location.href = "login.php";
        }, 3000); // 3000 milliseconds = 3 seconds
    </script>
</html>
