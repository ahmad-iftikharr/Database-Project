<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Teachers - Teacher Management</title>
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
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            color: #fff;
        }

        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
        }

        td {
            background-color: #333;
        }

        tr:nth-child(even) td {
            background-color: #555;
        }

        a {
            color: #4CAF50;
            text-decoration: none;
            transition: color 0.3s;
        }

        a:hover {
            color: #2a8f32;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            margin-bottom: 20px;
        }

        input[type="text"] {
            width: calc(100% - 24px);
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
    <h1>Name Search</h1>
    <form action="teacher_name.php" method="post">
        <input type="text" id="name" name="name" placeholder="Enter teacher's name" required>
        <input type="submit" value="Search">
    </form>

    <h1>Filtered Teachers</h1>
    <table>
        <thead>
            <tr>
                <th>Teacher ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Class</th>
                <th>Phone</th>
                <th>Subject</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                if (!empty($_POST["name"])) {
                    // Store form data in variables
                    $name = $_POST["name"];

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

                    // Prepare and execute SQL statement
                    $sql = "SELECT * FROM teacher WHERE name=? order by TeacherID asc";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $name);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["TeacherID"] . "</td>";
                            echo "<td>" . $row["Name"] . "</td>";
                            echo "<td>" . $row["Gender"] . "</td>";
                            echo "<td>" . $row["Class"] . "</td>";
                            echo "<td>" . $row["Phone"] . "</td>";
                            echo "<td>" . $row["Subject"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No teachers found</td></tr>";
                    }
                    $conn->close();
                }
            }
            ?>
        </tbody>
    </table>
</body>
</html>
