<?php
require_once 'getID3/getid3/getid3.php';

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
    $sectionTitles = $_POST['sectionTitle'];
    $lectureTitles = $_POST['lectureTitle'];
    $lectureDescriptions = $_POST['lectureDescription'];
    $durations = $_POST['duration'];
    $videos = $_FILES['video'];

    $courseId = isset($_SESSION['courseId']) ? $_SESSION['courseId'] : null;

    foreach ($sectionTitles as $index => $sectionTitle) {
        $sectionDescription = '';
        $orderNumber = $index + 1;

        $sqlInsertSection = "INSERT INTO section (course_id, section_title, section_description, order_number) VALUES (?, ?, ?, ?)";
        $stmtSection = $conn->prepare($sqlInsertSection);
        $stmtSection->bind_param('issi', $courseId, $sectionTitle, $sectionDescription, $orderNumber);

        if ($stmtSection->execute()) {
            $sectionId = $conn->insert_id;


            $sqlInsertLecture = "INSERT INTO lectures (section_id, lecture_title, lecture_description, video_url, duration) VALUES (?, ?, ?, ?, ?)";
            $stmtLecture = $conn->prepare($sqlInsertLecture);

            // Loop through the lecture details for the current section
            foreach ($lectureTitles[$index] as $lectureIndex => $lectureTitle) {
                $target_dir = "/home/bsetec/Desktop/uploads/";
                $target_file = $target_dir . basename($videos['name'][$index][$lectureIndex]);
                $videoPath = $videos['tmp_name'][$index][$lectureIndex];

                if (move_uploaded_file($videoPath, $target_file)) {
                    $getID3 = new getID3();
                    $videoInfo = $getID3->analyze($target_file);

                    if (isset($videoInfo['playtime_string'])) {
                        $duration = $videoInfo['playtime_string'];
                    } else {
                        $duration = null;
                        echo "Error getting video duration";
                    }

                    $webmPathSD = "/home/bsetec/Desktop/uploads/" . pathinfo($target_file, PATHINFO_FILENAME) . '_sd.webm';
                    $cmdConvertSD = "/usr/bin/ffmpeg -i $target_file -vf scale=720:480 -c:v libvpx -crf 10 -b:v 1M -c:a libvorbis $webmPathSD";
                    $conversionResultSD = shell_exec($cmdConvertSD);

                    if ($conversionResultSD === null) {
                        echo "Error executing FFmpeg conversion (SD): $cmdConvertSD";
                    } else {    
                        echo "FFmpeg conversion (SD) successful";
                    }

                    $webmPathHD = "/home/bsetec/Desktop/uploads/" . pathinfo($target_file, PATHINFO_FILENAME) . '_hd720p.webm';
                    $cmdConvertHD = "/usr/bin/ffmpeg -i $target_file -vf scale=1280:720 -c:v libvpx -crf 10 -b:v 1M -c:a libvorbis $webmPathHD";
                    $conversionResultHD = shell_exec($cmdConvertHD);

                    if ($conversionResultHD === null) {
                        echo "Error executing FFmpeg conversion (HD 720p): $cmdConvertHD";
                    } else {
                        echo "FFmpeg conversion (HD 720p) successful";
                    }

                    $webmPathFullHD = "/home/bsetec/Desktop/uploads/" . pathinfo($target_file, PATHINFO_FILENAME) . '_fullhd1080p.webm';
                    $cmdConvertFullHD = "/usr/bin/ffmpeg -i $target_file -vf scale=1920:1080 -c:v libvpx -crf 10 -b:v 1M -c:a libvorbis $webmPathFullHD";
                    $conversionResultFullHD = shell_exec($cmdConvertFullHD);

                    if ($conversionResultFullHD === null) {
                        echo "Error executing FFmpeg conversion (Full HD 1080p): $cmdConvertFullHD";
                    } else {
                        echo "FFmpeg conversion (Full HD 1080p) successful";
                    }

                    $stmtLecture->bind_param('issss', $sectionId, $lectureTitle, $lectureDescriptions[$index][$lectureIndex], $webmPathFullHD, $duration);

                    if ($stmtLecture->execute()) {
                        echo "Lecture inserted successfully";
                        $_SESSION['current_lecture_id'] = $conn->insert_id;

                        // Quiz creation logic
                        $quizTitle = htmlspecialchars($_POST["quiz_title"]);
                        $quizDescription = htmlspecialchars($_POST["quiz_description"]);

                        $lectureId = isset($_SESSION['current_lecture_id']) ? $_SESSION['current_lecture_id'] : null;

                        if ($lectureId === null) {
                            die("Error: Lecture ID not set in the session.");
                        }

                        $sqlQuiz = "INSERT INTO quiz (lecture_id, quiz_title, description) VALUES (?, ?, ?)";
                        $stmtQuiz = $conn->prepare($sqlQuiz);

                        $stmtQuiz->bind_param('iss', $lectureId, $quizTitle, $quizDescription);

                        if ($stmtQuiz->execute()) {
                            echo "Quiz details added successfully!";

                            $quizId = $conn->insert_id;

                            foreach ($_POST["questions"] as $questionIndex => $question) {
                                $questionTitle = htmlspecialchars($question);

                                $correctAnswerIndex = isset($_POST['correct_answer'][$questionIndex]) ? $_POST['correct_answer'][$questionIndex] : null;
                                $correctAnswerId = null; 

                                $sqlQuestion = "INSERT INTO quiz_questions (quiz_id, question_title, correct_answer) VALUES (?, ?, ?)";
                                $stmtQuestion = $conn->prepare($sqlQuestion);

                                $stmtQuestion->bind_param('iss', $quizId, $questionTitle, $correctAnswerId);

                                if ($stmtQuestion->execute()) {
                                    echo "Question inserted successfully!";
                                    $questionId = $conn->insert_id;

                                    $sqlAnswer = "INSERT INTO quiz_answers (question_id, answer_title, description) VALUES (?, ?, ?)";

                                    foreach ($_POST["answers"][$questionIndex]['title'] as $answerIndex => $answerTitle) {
                                        $answerDescription = $_POST["answers"][$questionIndex]['description'][$answerIndex];

                                        $stmtAnswer = $conn->prepare($sqlAnswer);
                                        $stmtAnswer->bind_param('iss', $questionId, $answerTitle, $answerDescription);

                                        if ($stmtAnswer->execute()) {
                                            echo "Answer inserted successfully!";
                                            $answerId = $conn->insert_id;

                                            // Check if the current answer is the correct one
                                            if ($answerIndex == $correctAnswerIndex) {
                                                $correctAnswerId = $answerId;
                                            }
                                        } else {
                                            echo "Error inserting answer: " . $stmtAnswer->error;
                                        }

                                        $stmtAnswer->close();
                                    }

                                    // Update the correct_answer column with the correct answer ID
                                    $stmtUpdateCorrectAnswer = $conn->prepare("UPDATE quiz_questions SET correct_answer = ? WHERE id = ?");
                                    $stmtUpdateCorrectAnswer->bind_param('ii', $correctAnswerId, $questionId);

                                    if ($stmtUpdateCorrectAnswer->execute()) {
                                        echo "Correct answer ID updated successfully!";
                                    } else {
                                        echo "Error updating correct answer ID: " . $stmtUpdateCorrectAnswer->error;
                                    }

                                    $stmtUpdateCorrectAnswer->close();

                                } else {
                                    echo "Error inserting question: " . $stmtQuestion->error;
                                }
                            }

                            echo "Quiz questions and answers added successfully!";
                        } else {
                            echo "Error inserting quiz: " . $stmtQuiz->error;
                        }
                    } else {
                        echo "Error creating lecture: " . $stmtLecture->error;
                    }
                } else {
                    echo "Error uploading video.";
                }
            }
        } else {
            echo "Error creating section: " . $stmtSection->error;
        }
    }

    header("Location: dashboard.php");
    exit;
} else {
    echo "Invalid request method";
}

$conn->close();
?>
