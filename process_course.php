<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input from the form
    $courseTitle = $_POST['courseTitle'];

    // Store the course title in a session variable for later use
    $_SESSION['courseTitle'] = $courseTitle;

    // Redirect to the category selection page
    header("Location: create3.php");
    exit();
} else {
    echo "Invalid request method";
}
?>
