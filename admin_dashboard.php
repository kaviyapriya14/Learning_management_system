<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learning Management System</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color:lightblue;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        header {
            background-color: white;
            padding: 1em;
            text-align: center;
            color: black;
            width: 100%;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo h1 {
            color: black;
            margin-left: 10px;
        }

        .search-bar {
            flex: 1;
            margin: -10px;
            position: relative;
            display: inline;
        }

        .search-bar input {
            width: 60%;
            padding: 8px 30px 8px 10px;
            border: 1px solid #ddd;
            border-radius: 100px;
            background-size: 20px;
        }

        h1 {
            color: black;
            display:inline-block;
            align-items: center;
            margin-top: 20px; /* Adjust as needed */
        }

        h1::before {
            content: '\1F393';
            margin-right: 10px;
            font-size: 1.5em;
        }

        .home-button button a {
            color: black;
            text-decoration: none;
        }

        .home-button button:hover {
            background-color: grey;
        }

        .home-button {
            display: inline;
            margin-left: 100px;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
        td{
            background-color:white;
        }
    </style>
</head>

<body class="custom">

    <header>
        <div class="logo">
            <h1>Udemy</h1>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="&#128269; Search courses...">
        </div>

        <div class="home-button">
            <button><a href="Home.php">Home</a></button>
        </div>
    </header>

    <div>
        <?php
        session_start();

        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "db_lms";

        $conn = new mysqli($servername, $username, $password, $db);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM user";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Created At</th><th>Updated At</th><th>Last Login</th><th>Status</th></tr>";
            
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["first_name"] . " " . $row["last_name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["created_at"] . "</td>";
                echo "<td>" . $row["updated_at"] . "</td>";
                echo "<td>" . $row["last_login"] . "</td>";
                echo "<td>" . $row["status"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No users found";
        }

        $conn->close();
        ?>
    </div>

</body>

</html>
