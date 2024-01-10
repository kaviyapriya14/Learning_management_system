<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_lms";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully!";

$insertRoles = "INSERT INTO role (role_name, description) VALUES
    ('admin', 'Administrator role'),
    ('tutor', 'Teacher role'),
    ('learner', 'Learner role')";

if ($conn->query($insertRoles) === TRUE) {
    echo "Roles inserted successfully!";
} else {
    echo "Error inserting roles: " . $conn->error;
}

$conn->close();
?>
