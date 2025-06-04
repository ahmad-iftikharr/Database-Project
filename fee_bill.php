<!DOCTYPE html>
<html>
<head>
    <title>Fee Bill</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .amount {
            border-top: 2px solid #333;
            padding-top: 10px;
            margin-top: 20px;
        }
        .header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            border-radius: 10px 10px 0 0;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Fee Bill</h2>
        </div>
        <div class="content">
            <?php
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

            // Fetch student details and fee amount from the database based on student ID
            if (isset($_GET['student_id'])) {
                $student_id = $_GET['student_id'];
                $sql = "SELECT student_Name, feeAmount FROM fee WHERE StudentID = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $student_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo "<p><strong>Student Name:</strong> " . $row['student_Name'] . "</p>";
                    echo "<p><strong>Student ID:</strong> " . $student_id . "</p>";
                    echo "<div class='amount'>";
                    echo "<p><strong>Total Fee Amount:</strong> $" . $row['feeAmount'] . "</p>";
                    echo "</div>";
                } else {
                    echo "<p>No student found with the provided ID.</p>";
                }
            } else {
                echo "<p>No student ID provided.</p>";
            }

            // Close connection
            $conn->close();
            ?>
        </div>
        <div class="footer">
            <p>Thank you for choosing us!</p>
        </div>
    </div>
</body>
</html>
