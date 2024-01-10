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
    // Get user input from the form
    $categoryId = $_POST['categoryId'];

    // Retrieve the course title from the session variable
    $courseTitle = isset($_SESSION['courseTitle']) ? $_SESSION['courseTitle'] : "";

    // Insert the course details into the course table
    $sqlInsertCourse = "INSERT INTO course (category_id, course_title) VALUES (?, ?)";
    $stmtCourse = $conn->prepare($sqlInsertCourse);
   $stmtCourse->bind_param('is', $categoryId, $courseTitle);

    if ($stmtCourse->execute()) {
        // Get the dynamically generated course_id
        $courseId = $conn->insert_id;
        $_SESSION['courseId'] = $courseId;
        // Insert Seventh Question related to the course
        $insertSeventhQuestion = "INSERT INTO questions (course_id, question_title, description, status)
            VALUES (?, 'How much time can you spend creating your course per week?', 'Specify the amount of time you can allocate for creating your course each week.', 'active')";
        
        $stmtSeventhQuestion = $conn->prepare($insertSeventhQuestion);
        $stmtSeventhQuestion->bind_param('i', $courseId);

        if ($stmtSeventhQuestion->execute()) {
            header("Location: create4.php");
            exit;       
         } else {
            echo "Error inserting the seventh question: " . $stmtSeventhQuestion->error;
        }
    } else {
        echo "Error creating course: " . $stmtCourse->error;
    }
} else {
    echo "Invalid request method";
}

$conn->close();
?>
