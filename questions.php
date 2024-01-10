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

// Insert Questions
$insertQuestions = "INSERT INTO questions (question_title, description, status)
    VALUES
    ('What kind of teaching have you done before?', 'Provide details about your previous teaching experience.', 'active')";

if ($conn->multi_query($insertQuestions) !== TRUE) {
    echo "Error inserting questions: " . $conn->error;
    exit;
}

// Get the inserted question ID
$result = $conn->query("SELECT id FROM questions WHERE question_title = 'What kind of teaching have you done before?'");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $questionId = $row["id"];
} else {
    echo "Error retrieving question ID.";
    exit;
}

// Insert Answers for the first question
$insertAnswers = "INSERT INTO answers (question_id, answer_title, description, status)
    VALUES
    ($questionId, 'In person, informally', 'Description for In person, informally', 'active'),
    ($questionId, 'In person, professionally', 'Description for In person, professionally', 'active'),
    ($questionId, 'Online', 'Description for Online', 'active'),
    ($questionId, 'Others', 'Description for Others', 'active')";

if ($conn->multi_query($insertAnswers) === TRUE) {
    echo "Questions and Answers inserted successfully!";
} else {
    echo "Error inserting answers: " . $conn->error;
}




// Insert Questions
$insertQuestions = "INSERT INTO questions (question_title, description, status)
    VALUES
    ('How much of video \'pro\' are you?', 'Describe your proficiency in creating professional-quality videos.', 'active')";

if ($conn->multi_query($insertQuestions) !== TRUE) {
    echo "Error inserting questions: " . $conn->error;
    exit;
}

// Get the inserted question ID
$result = $conn->query("SELECT id FROM questions WHERE question_title = 'How much of video \'pro\' are you?'");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $questionId = $row["id"];
} else {
    echo "Error retrieving question ID.";
    exit;
}

// Insert Answers for the second question
$insertAnswers = "INSERT INTO answers (question_id, answer_title, description, status)
    VALUES
    ($questionId, 'I\'m a beginner', 'Description for I\'m a beginner', 'active'),
    ($questionId, 'I have some knowledge', 'Description for I have some knowledge', 'active'),
    ($questionId, 'I\'m experienced', 'Description for I\'m experienced', 'active'),
    ($questionId, 'I have a video ready to upload', 'Description for I have a video ready to upload', 'active')";

if ($conn->multi_query($insertAnswers) === TRUE) {
    echo "Questions and Answers inserted successfully!";
} else {
    echo "Error inserting answers: " . $conn->error;
}

$insertQuestions = "INSERT INTO questions (question_title, description, status)
    VALUES
    ('Do you have an audience to share your course with?', 'Explain if you already have an audience to promote your course to.', 'active')";

if ($conn->multi_query($insertQuestions) !== TRUE) {
    echo "Error inserting questions: " . $conn->error;
    exit;
}

// Get the inserted question ID
$result = $conn->query("SELECT id FROM questions WHERE question_title = 'Do you have an audience to share your course with?'");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $questionId = $row["id"];
} else {
    echo "Error retrieving question ID.";
    exit;
}

// Insert Answers for the third question
$insertAnswers = "INSERT INTO answers (question_id, answer_title, description, status)
    VALUES
    ($questionId, 'Not at the moment', 'Description for Not at the moment', 'active'),
    ($questionId, 'I have a small following', 'Description for I have a small following', 'active'),
    ($questionId, 'I have a sizeable following', 'Description for I have a sizeable following', 'active')";

if ($conn->multi_query($insertAnswers) === TRUE) {
    echo "Questions and Answers inserted successfully!";
} else {
    echo "Error inserting answers: " . $conn->error;
}


//fourth question
$insertQuestions = "INSERT INTO questions (question_title, description, status)
    VALUES
    ('First, let\\'s find out what type of course you\\'re making.', 'Select the type of course you are creating.', 'active')";


if ($conn->multi_query($insertQuestions) !== TRUE) {
    echo "Error inserting questions: " . $conn->error . "<br>";
    exit;
}

// Get the inserted question ID
$result = $conn->query("SELECT id FROM questions WHERE question_title = 'First, let\\'s find out what type of course you\\'re making.'");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $questionId = $row["id"];

} else {
    echo "Error retrieving question ID: " . $conn->error . "<br>";
    exit;
}

// Insert Answers for the fourth question
$insertAnswers = "INSERT INTO answers (question_id, answer_title, description, status)
    VALUES
    ($questionId, 'Course', 'Description for Course', 'active'),
    ($questionId, 'Practice test', 'Description for Practice test', 'active')";


if ($conn->multi_query($insertAnswers) === TRUE) {
    echo "Questions and Answers inserted successfully!";
} else {
    echo "Error inserting answers: " . $conn->error . "<br>";
}

$insertFifthQuestion = "INSERT INTO questions (question_title, description, status)
    VALUES
    ('How about a working title?', 'Provide a working title for your course.', 'active')";

if ($conn->multi_query($insertFifthQuestion) !== TRUE) {
    echo "Error inserting questions: " . $conn->error . "<br>";
    exit;
}else{
    echo "Inserted successfully";
}

// Insert the sixth question
$insertSixthQuestion = "INSERT INTO questions (question_title, description, status)
    VALUES
    ('What category best fits the knowledge you\\'ll share?', 'Select the category that best describes your course content.', 'active')";

if ($conn->query($insertSixthQuestion) !== TRUE) {
    echo "Error inserting the sixth question: " . $conn->error . "<br>";
    exit;
}

// Get the inserted question ID
$result = $conn->query("SELECT id FROM questions WHERE question_title = 'What category best fits the knowledge you\\'ll share?'");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $questionId = $row["id"];
} else {
    echo "Error retrieving question ID: " . $conn->error . "<br>";
    exit;
}


// Insert the seventh question
$insertSeventhQuestion = "INSERT INTO questions (question_title, description, status)
    VALUES
    ('How much time can you spend creating your course per week?', 'Specify the amount of time you can allocate for creating your course each week.', 'active')";

if ($conn->multi_query($insertSeventhQuestion) !== TRUE) {
    echo "Error inserting the seventh question: " . $conn->error;
    exit;
}

// Get the inserted question ID
$result = $conn->query("SELECT id FROM questions WHERE question_title = 'How much time can you spend creating your course per week?'");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $questionId = $row["id"];
} else {
    echo "Error retrieving question ID.";
    exit;
}

// Insert Answers for the Seventh Question
$insertAnswersSeventhQuestion = "INSERT INTO answers (question_id, answer_title, description, status)
    VALUES
    ($questionId, 'I\'m very busy right now (0-2 hours)', 'Description for I\'m very busy right now (0-2 hours)', 'active'),
    ($questionId, 'I\'ll work on this on the side (2-4 hours)', 'Description for I\'ll work on this on the side (2-4 hours)', 'active'),
    ($questionId, 'I have lots of flexibility (+5 hours)', 'Description for I have lots of flexibility (+5 hours)', 'active'),
    ($questionId, 'I haven\'t yet decided if I have time', 'Description for I haven\'t yet decided if I have time', 'active')";

if ($conn->multi_query($insertAnswersSeventhQuestion) === TRUE) {
    echo "Seventh Question and Answers inserted successfully!";
} else {
    echo "Error inserting seventh question answers: " . $conn->error . "<br>";
}

$insertEighthQuestion = "INSERT INTO questions (question_title, description, status)
    VALUES
    ('What will students learn in your course?', 'Provide information about the key learning outcomes of your course.', 'active')";

if ($conn->query($insertEighthQuestion) !== TRUE) {
    echo "Error inserting question: " . $conn->error . "<br>";
    exit;
} else {
    echo "Inserted successfully";
}

$insertNinthQuestion = "INSERT INTO questions (question_title, description, status)
    VALUES
    ('What are the requirements or prerequisites for taking your course?', 'Specify any prerequisites or requirements that students should meet before enrolling in your course.', 'active')";

if ($conn->query($insertNinthQuestion) !== TRUE) {
    echo "Error inserting question: " . $conn->error . "<br>";
    exit;
} else {
    echo "Inserted successfully";
}

$insertTenthQuestion = "INSERT INTO questions (question_title, description, status)
    VALUES
    ('Who is this course for?', 'Describe the target audience or individuals for whom this course is intended.', 'active')";

if ($conn->query($insertTenthQuestion) !== TRUE) {
    echo "Error inserting question: " . $conn->error . "<br>";
    exit;
} else {
    echo "Inserted successfully";
}






$conn->close();
?>




