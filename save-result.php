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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user_id from the session
    $user_id = $_SESSION["user_id"];

    // Retrieve selected option from the form
    $selected_option = isset($_POST["selected_option"]) ? $_POST["selected_option"] : null;

    // Retrieve the question_id based on the selected option or null
    if ($selected_option !== null) {
        $questionQuery = "SELECT question_id FROM answers WHERE id = $selected_option";
        $questionResult = $conn->query($questionQuery);

        if ($questionResult->num_rows > 0) {
            $questionData = $questionResult->fetch_assoc();
            $question_id = $questionData['question_id'];
        } else {
            echo "Error: Selected option not found.";
            exit();
        }
    } else {
        // For user input questions where selected_option is null
        $question_id = isset($_POST["question_id"]) ? $_POST["question_id"] : null;
    }

    // Ensure $question_id has a default value if not set
    $question_id = $question_id ?? null;

    // Retrieve user input for user input questions
    $user_input = isset($_POST["user_input"]) ? $_POST["user_input"] : null;

    // Insert the result into the result table
    $insertResultQuery = "INSERT INTO result (user_id, question_id, answer_id, user_input) 
                         VALUES ($user_id, ";

    // Use appropriate handling for NULL or the selected option
    if ($question_id !== null) {
        $insertResultQuery .= "$question_id,";
    } else {
        $insertResultQuery .= "NULL,";
    }

    // Use appropriate handling for NULL or the selected option
    if ($selected_option !== null) {
        $insertResultQuery .= "$selected_option,";
    } else {
        $insertResultQuery .= "NULL,";
    }

    // Complete the query with user input
    $insertResultQuery .= "'$user_input')";
    echo "Query: $insertResultQuery<br>";



    // Check for errors in the query execution
    if ($conn->query($insertResultQuery) === TRUE) {
        // Determine the next step based on the previous step
        $prev_step = isset($_POST["prev_step"]) ? $_POST["prev_step"] : "";
        $next_step = "";

        switch ($prev_step) {
            case "teaching_experience":
                $next_step = "video-experience.php";
                break;
            case "video-experience":
                $next_step = "existing-audience.php";
                break;
            case "existing-audience":
                $next_step = "courses_dashboard.php";
                break;
            case "create1":
                $next_step = "create2.php";
                break;
            case "create2":
                $next_step="create3.php";
                break;
            case "create3":
                $next_step="create4.php";
                break;
            case "create4":
                $next_step="dashboard.php";
                break;

            default:
                $next_step = "teach_on_udemy_dashboard.php";
        }

        // Debugging statements
        echo "Prev Step: $prev_step<br>";
        echo "Next Step: $next_step<br>";

        
        header("Location: $next_step");
        exit();
    } else {
        echo "Error saving result: " . $conn->error;
    }
}

$conn->close();
?>