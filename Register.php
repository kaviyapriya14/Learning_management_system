<?php
session_start();
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "db_lms";

    $conn = new mysqli($servername, $username, $password, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    $password = $_POST["password"];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $created_at = date("Y-m-d H:i:s");
    $updated_at = date("Y-m-d H:i:s");
    $last_login = date("Y-m-d H:i:s");

     $default_role_id = 3;


    $sql = "INSERT INTO user (role_id, first_name, last_name, email, phone_number, password, created_at, updated_at, last_login, status) 
            VALUES ($default_role_id, '$first_name', '$last_name', '$email', '$phone_number', '$hashedPassword', '$created_at', '$updated_at', '$last_login', 'active')";

    if ($conn->query($sql) === TRUE) {
        $successMessage = "User registered successfully!";  
        $_SESSION['success_message'] = $successMessage;
        header("Location: learner_dashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    
    <?php 
        if (!empty($successMessage)) {
            echo '<p>' . $successMessage . '</p>';
        }
        ?>

        <form method="post" action="Register.php" onsubmit="return validateForm()" novalidate autocomplete="off">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required autocomplete="off">
        <div id="first_name_error" class="error-message"></div><br>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required autocomplete="off">
        <div id="last_name_error" class="error-message"></div><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required autocomplete="off">
        <div id="email_error" class="error-message"></div><br>

        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" required autocomplete="off">
        <div id="phone_number_error" class="error-message"></div><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required autocomplete="off">
        <div id="password_error" class="error-message"></div><br>

        <input type="submit" value="Register">

        
        </form>
    </div>

    <script src="Register.js"></script>
</body>
</html>
