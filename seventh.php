<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "db_lms";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert the course first 
$courseTitle = $_POST['courseTitle'];
$categoryId = $_POST['categoryId'];

$sqlInsertCourse = "INSERT INTO course (category_id, course_title) VALUES ($categoryId, '$courseTitle')";

if ($conn->query($sqlInsertCourse) === TRUE) {
    echo "Course inserted successfully!";
} else {
    echo "Error inserting course: " . $conn->error;
    exit;
}

// Get the dynamically generated course_id
$result = $conn->query("SELECT id FROM course WHERE category_id = $categoryId AND course_title = '$courseTitle'");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $courseId = $row["id"];

    // Store the course_id in the session
    $_SESSION['course_id'] = $courseId;

    $insertSeventhQuestion = "INSERT INTO questions (course_id, question_title, description, status)
        VALUES
        ($courseId, 'How much time can you spend creating your course per week?', 'Specify the amount of time you can allocate for creating your course each week.', 'active')";

    if ($conn->query($insertSeventhQuestion) !== TRUE) {
        echo "Error inserting the seventh question: " . $conn->error;
    } else {
        echo "Seventh Question inserted successfully!";
    }

    // Get the inserted question ID
    $result = $conn->query("SELECT id FROM questions WHERE question_title = 'How much time can you spend creating your course per week?' AND course_id = $courseId");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $questionId = $row["id"];

        $insertAnswersSeventhQuestion = "INSERT INTO answers (question_id, answer_title, description, status)
            VALUES
            ($questionId, 'I\'m very busy right now (0-2 hours)', 'Description for I\'m very busy right now (0-2 hours)', 'active'),
            ($questionId, 'I\'ll work on this on the side (2-4 hours)', 'Description for I\'ll work on this on the side (2-4 hours)', 'active'),
            ($questionId, 'I have lots of flexibility (+5 hours)', 'Description for I have lots of flexibility (+5 hours)', 'active'),
            ($questionId, 'I haven\'t yet decided if I have time', 'Description for I haven\'t yet decided if I have time', 'active')";

        if ($conn->multi_query($insertAnswersSeventhQuestion) === TRUE) {
            echo "Seventh Question and Answers inserted successfully!";
        } else {
            echo "Error inserting seventh question answers: " . $conn->error;
        }
    } else {
        echo "Error retrieving question ID.";
    }
} else {
    echo "Error retrieving course ID.";
}

$conn->close();
?>
