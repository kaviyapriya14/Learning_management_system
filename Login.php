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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $sql = "SELECT id, role_id, password FROM user WHERE email = '$email' AND status = 'active'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {

            $user_id = $row["id"];
            $update_last_login_sql = "UPDATE user SET last_login = NOW() WHERE id = $user_id";
            $conn->query($update_last_login_sql);

            $_SESSION["user_id"] = $row["id"];
            $_SESSION["role_id"] = $row["role_id"];

            if ($_SESSION["role_id"] == 1) {
                header("Location: admin_dashboard.php");
                exit();
            } elseif ($_SESSION["role_id"] == 2) {
                header("Location: teacher_dashboard.php");
                exit();
            } elseif ($_SESSION["role_id"] == 3) {
                header("Location: learner_dashboard.php");
                exit();
            }
        } else {
            $passwordError ="Invalid password";
        }
    } else {
        $emailError= "User not found";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<form method="post" action="Login.php" novalidate autocomplete="off">

    <label for="email"><i class="fa fa-envelope" style="font-size:19px"></i> Email:</label>
    <input type="text" id="email" name="email" required autocomplete="off">
    <div id="email_error" class="error-message"><?php echo $emailError; ?></div><br>

    <label for="password"><i class="fa fa-lock" style="font-size:20px"></i> Password:</label>
    <input type="password" id="password" name="password" required autocomplete="off">
    <div id="password_error" class="error-message"><?php echo $passwordError; ?></div><br>

    <input type="submit" value="Login">
    <h6 style="display: inline-block;">If you are a new user?</h6>
    <a href="Register.php">Register Here</a>
</form>
</body>
</html>
