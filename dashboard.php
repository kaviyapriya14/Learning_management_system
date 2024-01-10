<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Navigation</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

</head>
<body>
    <header>
        <a href="courses_dashboard.php">&#8592; back to course</a>
    </header>
    <div class="container">
        <nav>
            <ul>
                <h4>Plan your course</h4>
                <li>
                    <input type="radio" id="intended-learner" name="navigator" checked>
                    <label for="intended-learner"><a href="#">Intended Learner</a></label>
                </li>
                <h4>Create your content</h4>
                <li>
                    <input type="radio" id="curriculum" name="navigator">
                    <label for="curriculum"><a href="#">Curriculum</a></label>
                </li>
                <h4>Publish your course</h4>
                <li>
                    <input type="radio" id="course-landing" name="navigator">
                    <label for="course-landing">Course Landing Page</label>
                </li>
            </ul>
        </nav>

        <div class="content" id="intended-learner-content">
            <h2>Intended Learner</h2>
            <hr>
            <p class="intro">The following descriptions will be publicly visible on your Course Landing Page and will have a direct impact on your course performance. These descriptions will help learners decide if your course is right for them.</p>
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

            if (isset($_SESSION["user_id"])) {
                $user_id = $_SESSION["user_id"];
            } else {
                echo "Error: User not logged in";
                exit;
            }

            $questionQuery = "SELECT * FROM questions WHERE status = 'active' ORDER BY id LIMIT 3 OFFSET 10";
            $questionResult = $conn->query($questionQuery);

            if ($questionResult->num_rows > 0) {
                $questions = $questionResult->fetch_all(MYSQLI_ASSOC);
            } else {
                echo "No active questions found.";
                exit;
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["save"])) {
                $user_inputs = array();

                for ($i = 0; $i < 3; $i++) {
                    $input_name = "user_input_" . ($i + 12);
                    $user_inputs[$i] = $_POST[$input_name];
                }

                foreach ($questions as $key => $questionData) {
                    $questionId = $questionData['id'];
                    $user_input = $user_inputs[$key];
                    $insertIntendedLearner = "INSERT INTO intended_learner (user_id, question_id, user_input, created_at, updated_at)
                        VALUES ('$user_id', '$questionId', '$user_input', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";

                    if ($conn->query($insertIntendedLearner) !== TRUE) {
                        echo "Error inserting intended learner data: " . $conn->error . "<br>";
                    }else {
                        echo '<script>';
                        echo '$(document).ready(function() {';
                        echo 'if (!$("#toast-container").length) {'; 
                        echo 'toastr.success("Saved successfully!");';
                        echo '}';
                        echo '});';
                        echo '</script>';
                    }
                }

            }

            $conn->close();
            ?>

            <form action="" method="post">
                <?php foreach ($questions as $key => $questionData): ?>
                    <h3><?php echo $questionData['question_title']; ?></h3>
                    <textarea id="user_input_<?php echo ($key + 12); ?>" name="user_input_<?php echo ($key + 12); ?>" rows="4" cols="50" required></textarea><br>
                <?php endforeach; ?>
                <footer>
                    <button type="submit" name="save">Save</button>
                </footer>
            </form>
        </div>

        <div class="content" id="curriculum-content">
            <h2>Curriculum</h2>
            <hr>
            <p class="intro">Start putting together your course by creating sections, lectures and practice activities (quizzes, coding exercises and assignments). Use your course outline to structure your content and label your sections and lectures clearly. If you’re intending to offer your course for free, the total length of video content must be less than 2 hours.
                </p>
            <form action="section.php" method="post" enctype="multipart/form-data" id="courseForm" style="max-width:900px;">
                <div class="box" id="rapper" style="border-radius:0px;">
                    <div class="form-group">
                        <label for="sectionTitle">Section Title:</label>
                        <input type="text" placeholder="Enter the section" name="sectionTitle[]" required>
                    </div>

                    <div class="dynamic-section" id="dynamicSectionsContainer0">
                        <div class="form-group">
                            <label for="lectureTitle">Lecture Title:
                                <button type="button" onclick="addContent(0)" class="add-content-button">+ Content</button>
                                <button type="button" onclick="addDescription(0)" class="add-description-button"> Description</button>
                            </label>
                            <input type="text" placeholder="Enter the lecture title" name="lectureTitle[0][]" required>
                        </div>

                        <div class="form-group description-container">

                        </div>

                        <div class="form-group video-container">
        
                        </div>
                        <button type="button" onclick="addCurriculum()">+ Curriculum item</button>
                    </div>
                </div>

                <div id="quizContainer" >
                <div id="titleContainer">
                <input type="text" name="quiz_title" placeholder="Enter Quiz Title" required><br><br>
                <input type="text" name="quiz_description" placeholder="Enter Quiz Description" required><br>
                
                            </div> 
                            <div id="QAContainer">     
                            <label for="questions">Enter Quiz Questions:</label>
                            <div id="questionContainer">
                                <div class="question">
                                    <input type="text" name="questions[]" placeholder="Enter Question" required><br>
                                    <div class="answerContainer">
                                        <input type="radio" name="correct_answer[0]" value="0" required>
                                        <input type="text" name="answers[0][title][]" placeholder="Enter Answer" required><br><br>
                                        <input type="text" id="ans-des" name="answers[0][description][]" style="margin-left:25px;" placeholder="Enter Answer Description" required><br><br>
                                    </div>
                                    <button type="button" onclick="addAnswer(0)">Add Answer</button><br><br>
                                </div>
                            </div>
                            
                            <button type="button" onclick="addQuestion()">Add Question</button>
                        </div>
                            </div>
                <button id="section-button" type="button" onclick="addSection()">+ Section</button>

                <div id="dynamicSectionsContainer"></div>

                <button id="submit-button" type="submit">Submit</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const navigationItems = document.querySelectorAll('[name="navigator"]');
            const contentSections = document.querySelectorAll('.content');

            function showSelectedContent() {
                const selectedNavItem = document.querySelector('[name="navigator"]:checked');
                const selectedContentId = selectedNavItem.getAttribute('id') + '-content';

                contentSections.forEach(section => {
                    section.style.display = 'none';
                });

                const selectedContent = document.getElementById(selectedContentId);

                if (selectedContent) {
                    selectedContent.style.display = 'block';
                }
            }

            navigationItems.forEach(item => {
                item.addEventListener('change', showSelectedContent);
            });

            showSelectedContent();
        });
    </script>
    <script src="dashboard.js"></script>
</body>
</html>
