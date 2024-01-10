<?php
$servername="localhost";
$username="root";
$password="";

$conn=new mysqli($servername,$username,$password);
if($conn->connect_error){
    die("connection failed: ".$conn->connect_error);
}
$databaseName="db_lms";
$sql="CREATE DATABASE IF NOT EXISTS $databaseName";

if ($conn->query($sql) === TRUE) {
    echo "Database '$databaseName' created successfully!";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->select_db($databaseName);

$sqlroletable="CREATE TABLE IF NOT EXISTS role(
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL,
    description VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('active','inactive')DEFAULT 'active'
    )";
if($conn->query($sqlroletable)==TRUE){
    echo "Table 'role' created successfully!";
}else{
    echo "Error creating table: ".$conn->error;
}
$sqlcreatetable="CREATE TABLE IF NOT EXISTS user(
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_id INT NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20),
    password VARCHAR(60) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    last_login TIMESTAMP,
    status ENUM('active', 'inactive') DEFAULT 'active',
    FOREIGN KEY (role_id) REFERENCES role(id)
)";
if($conn->query($sqlcreatetable)==TRUE){
    echo "Table 'users' created successfully!";
}else{
    echo"Error creating table: ".$conn->error;
}

$sqlcategorytable="CREATE TABLE IF NOT EXISTS categories(
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(50) NOT NULL,
    description VARCHAR(100)
    )";
    if($conn->query($sqlcategorytable)==TRUE){
        echo "Table 'categories' creaetd successfully!";
    }else{
        echo "Error creating table: ".$conn->error;
    }

$sqlcoursetable="CREATE TABLE IF NOT EXISTS course(
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    course_title VARCHAR(100) NOT NULL,
    short_description VARCHAR(60),
    rating DECIMAL(1,1),
    instructor VARCHAR(100),
    last_update TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    long_description VARCHAR(255),
    FOREIGN KEY (category_id) REFERENCES categories(id)
)";
  if($conn->query($sqlcoursetable)==TRUE){
    echo "Table 'course' created successfully!";
  }else{
    echo "Error creating table: ".$conn->error;
  }
/*
  $insertcategories = "INSERT INTO categories(category_name, description)
    VALUES
    ('Finance & Accounting', 'Category for Finance & Accounting knowledge'),
    ('IT & Software', 'Category for IT & Software knowledge'),
    ('Office Productivity', 'Category for Office Productivity knowledge'),
    ('Personal development', 'Category for Personal development knowledge'),
    ('Design', 'Category for Design knowledge'),
    ('Marketing', 'Category for Marketing knowledge'),
    ('Life style', 'Category for Life style knowledge'),
    ('Photography & Video', 'Category for Photography & Video knowledge'),
    ('Health & Fitness', 'Category for Health & Fitness knowledge'),
    ('Music', 'Category for Music knowledge'),
    ('Teaching and Academics', 'Category for Teaching and Academics knowledge'),
    ('I don\\'t know yet', 'Option for I don\\'t know yet')";

if ($conn->multi_query($insertcategories) === TRUE) {
    echo "categories inserted successfully!";
} else {
    echo "Error inserting categories: " . $conn->error . "<br>";
}

*/
$sqlquestiontable="CREATE TABLE IF NOT EXISTS questions(
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT,
    question_title VARCHAR(100) NOT NULL,
    description VARCHAR(100),
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES course(id)
)";
if($conn->query($sqlquestiontable)==TRUE){
    echo "Table 'questions' created successfully!";
}else{
    echo "Error created table: ".$conn->error;
}


$sqlanswertable="CREATE TABLE IF NOT EXISTS answers(
    id INT AUTO_INCREMENT PRIMARY KEY,
    question_id INT NOT NULL,
    answer_title VARCHAR(50) NOT NULL,
    description VARCHAR(100),
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (question_id) REFERENCES questions(id)
)";
if($conn->query($sqlanswertable)==TRUE){
    echo "Table 'answer' created successfully!";
}else{
    echo "Error created table: ".$conn->error;
}

$sqlresulttable="CREATE TABLE IF NOT EXISTS result(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    question_id INT NOT NULL,
    answer_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    user_input VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (question_id) REFERENCES questions(id),
    FOREIGN KEY (answer_id) REFERENCES answers(id)
)";
if($conn->query($sqlresulttable)==TRUE){
    echo "Table 'result' created successfully!";
}else{
    echo "Error created table: ".$conn->error;
}


$sqlsectiontable="CREATE TABLE IF NOT EXISTS section(
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT NOT NULL,
    section_title VARCHAR(60) NOT NULL,
    section_description VARCHAR(100),
    order_number INT NOT NULL,
    FOREIGN KEY (course_id) REFERENCES course(id)
)";
if($conn->query($sqlsectiontable)==TRUE){
    echo "Table 'section' created successfully!";
}else{
    echo "Error creating table: ".$conn->error;
}


$sqllecturetable="CREATE TABLE IF NOT EXISTS lectures(
    id INT AUTO_INCREMENT PRIMARY KEY,
    section_id INT NOT NULL,
    lecture_title VARCHAR(60) NOT NULL,
    lecture_description VARCHAR(100),
    video_url VARCHAR(255) NOT NULL,
    duration VARCHAR(10),
    FOREIGN KEY (section_id) REFERENCES section(id)
)";
if($conn->query($sqllecturetable)==TRUE){
    echo "Table 'lectures' created successfully!";
}else{
    echo "Error creating table: ".$conn->error;
}

$sqlintendedtable="CREATE TABLE IF NOT EXISTS intended_learner(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    question_id INT NOT NULL,
    user_input VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY(user_id) REFERENCES user(id),
    FOREIGN KEY(question_id) REFERENCES questions(id)
)";
if($conn->query($sqlintendedtable)==TRUE){
    echo "Table 'intended' created successfully!";
}else{
    echo "Error created table: ".$conn->error;
}

$sqlpracticetesttable="CREATE TABLE IF NOT EXISTS practice_test(
    id INT AUTO_INCREMENT PRIMARY KEY,
    intended_learner_id INT NOT NULL,
    file_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY(intended_learner_id) REFERENCES intended_learner(id)
)";
if($conn->query($sqlpracticetesttable)==TRUE){
    echo "Table 'practice test' created successfully!";
}else{
    echo "Error created table: ".$conn->error;
}

$sqlcourselandingpagetable = "CREATE TABLE IF NOT EXISTS course_landing_page(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    course_title VARCHAR(255),
    subtitle VARCHAR(255),
    description VARCHAR(100),
    image_url VARCHAR(255),
    video_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(id)
)";
if ($conn->query($sqlcourselandingpagetable) == TRUE) {
    echo "Table 'course_landing_page' created successfully!<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

$sqlcurrencytable="CREATE TABLE IF NOT EXISTS currencies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    currency_code VARCHAR(3) NOT NULL,
    currency_name VARCHAR(50) NOT NULL,
    currency_symbol VARCHAR(5),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
if($conn->query($sqlcurrencytable)==TRUE){
    echo "Table 'currency' created successfully!";
}else{
    echo "Error created table: ".$conn->error;
}

$sqlpricetiertable="CREATE TABLE IF NOT EXISTS price_tiers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tier_name VARCHAR(50) NOT NULL,
    description VARCHAR(50),
    price DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
if($conn->query($sqlpricetiertable)==TRUE){
    echo "Table 'tier' created successfully!";
}else{
    echo "Error created table: ".$conn->error;
}

$sqlpricingtable="CREATE TABLE IF NOT EXISTS pricing_table (
    id INT AUTO_INCREMENT PRIMARY KEY,
    currency_id INT NOT NULL,
    price_tier_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (currency_id) REFERENCES currencies(id),
    FOREIGN KEY (price_tier_id) REFERENCES price_tiers(id)
)";
if($conn->query($sqlpricingtable)==TRUE){
    echo "Table 'pricing' created successfully!";
}else{
    echo "Error created table: ".$conn->error;
}


$sqlcoursemessagetable="CREATE TABLE IF NOT EXISTS course_message(
    id INT AUTO_INCREMENT PRIMARY KEY,
    welcome_message VARCHAR(50),
    congrats_message VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
if($conn->query($sqlcoursemessagetable)==TRUE){
    echo "Table 'message course' created successfully!";
}else{
    echo "Error created table: ".$conn->error;
}


$sqlquiztable="CREATE TABLE IF NOT EXISTS quiz(
    id INT AUTO_INCREMENT PRIMARY KEY,
    lecture_id INT NOT NULL,
    quiz_title VARCHAR(80),
    description VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (lecture_id) REFERENCES lectures(id)
)";
if($conn->query($sqlquiztable)==TRUE){
    echo "Table 'quiz' created successfully!";
}else{
    echo "Error created table: ".$conn->error;
}


$sqlquizquestionstable="CREATE TABLE IF NOT EXISTS quiz_questions(
    id INT AUTO_INCREMENT PRIMARY KEY,
    quiz_id INT NOT NULL,
    question_title VARCHAR(255),
    correct_answer VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (quiz_id) REFERENCES quiz(id)
)";
if($conn->query($sqlquizquestionstable)==TRUE){
    echo "Table 'quiz questions' created successfully!";
}else{
    echo "Error created table: ".$conn->error;
}


$sqlquizanswerstable="CREATE TABLE IF NOT EXISTS quiz_answers(
    id INT AUTO_INCREMENT PRIMARY KEY,
    question_id INT NOT NULL,
    answer_title VARCHAR(255),
    description VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (question_id) REFERENCES quiz_questions(id)
)";
if($conn->query($sqlquizanswerstable)==TRUE){
    echo "Table 'quiz answer' craeted successfully!";
}else{
    echo "Error created table: ".$conn->error;
}
$conn->close(); 

?>

