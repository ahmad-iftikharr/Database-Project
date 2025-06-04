<?php
// Database connection parameters
$host = "localhost"; // Change this to your database host if it's different
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password if you have one
$database = "proj"; // Change this to your database name

// Initialize variables for form input and error messages
$usernameInput = $passwordInput = "";
$usernameErr = $passwordErr = "";
$loginErr = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else {
        $usernameInput = test_input($_POST["username"]);
    }

    // Validate password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $passwordInput = test_input($_POST["password"]);
    }

    // If both fields are provided, proceed with user authentication
    if (!empty($usernameInput) && !empty($passwordInput)) {
        // Create connection
        $conn = new mysqli($host, $username, $password, $database);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare SQL statement to retrieve user data from the database
        $stmt = $conn->prepare("SELECT Username, PasswordHash FROM Users WHERE Username = ?");
        $stmt->bind_param("s", $usernameInput);

        // Execute the statement
        $stmt->execute();
        $stmt->store_result();

        // Check if the user exists
        if ($stmt->num_rows > 0) {
            // Bind the result variables
            $stmt->bind_result($username, $passwordHash);
            $stmt->fetch();

            // Verify the password
            if (password_verify($passwordInput, $passwordHash)) {
                // Password is correct, set session variables and redirect to dashboard
                session_start();
                $_SESSION["username"] = $username;
                header("Location: dashboard.php");
                exit;
            } else {
                // Password is incorrect
                $loginErr = "Incorrect password";
            }
        } else {
            // Username does not exist
            $loginErr = "User not found";
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
    <title>Login - School Management System</title>
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
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(20, 20, 20, 0.8); /* Set box background color to translucent white */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        h2 {
            margin-bottom: 20px;
        }

        input {
            width: 100%;
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

        .login-error {
            color: #4e8cff; /* Set color to blue for login error message */
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="username" placeholder="Username" value="<?php echo $usernameInput; ?>" required>
            <span class="error"><?php echo $usernameErr; ?></span>
            <input type="password" name="password" placeholder="Password" required>
            <span class="error"><?php echo $passwordErr; ?></span>
            <button type="submit" class="btn">Login</button>
            <span class="login-error"><?php echo $loginErr; ?></span>
        </form>
    </div>
</body>
</html>
