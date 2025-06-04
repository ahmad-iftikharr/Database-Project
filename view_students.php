<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Students - Student Management</title>
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

    .btn {
            display: inline-block;
            padding:8px;
            background-color: darkred;
            color: #fff;
            text-decoration: none;
            border-radius: 5px
            transition: background-color 0.5s;
            transition: color 0.5s;
            font-size: 1.2em;
            margin:auto;
            border: 2px solid white;

        }

        .btn:hover {
            background-color: lightgreen; 
            transform: translateY(8px);
            color:black;
        }

        
    </style>
</head>
<body>
    <h1> All Students</h1>
    <table>
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Class</th>
                <th>Guardian Phone</th>
            </tr>
        </thead>
        <tbody>
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

            // Fetch student data from the database
            $sql = "SELECT * FROM student";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["StudentID"] . "</td>";
                    echo "<td>" . $row["Name"] . "</td>";
                    echo "<td>" . $row["Gender"] . "</td>";
                    echo "<td>" . $row["Class"] . "</td>";
                    echo "<td>" . $row["GuardianPhone"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No students found</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
        </table>
   <footer>
    <div>
    <a href="student_grade.php"class="btn">Search students by grade</a>
    <a href="student_name.php"class="btn">Search students by name</a>
    </div>
   </footer>
   
</body>
</html>
