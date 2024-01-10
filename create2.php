<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create2</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0; 
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: left;
            justify-content: center;
               
        
        }

        header {
            display: flex;
            align-items: center;
            padding:1em;
            background-color: #ddd;
            text-align:center;
            
        
        }

        h1::before {
            content: '\1F393';
            margin-right: 10px;
            font-size: 1.5em;
        }

        h1 {
            display: inline-block;
            margin: 0; 
        }

        h2 {
            color: #333;
            margin-left: 0;
            font-size:20px;
            text-align:center;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items:center;
        }

       

        input[type="radio"] {
            margin-right: 5px;
        }

        button {
            background-color: grey;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 0px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        button:hover {
            background-color: #45a049;
        }
       
        #steps {
            margin-top: 35px;
            margin-left: 30px;
        }

        footer {
            margin-top: auto;
            text-align: left;
            padding: 10px;
            background-color: #ddd;
            width: 100%;
            position:fixed;
            bottom:0;
        }
        #heading{
            font-size:35px;
            font-family:"font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif";
        }
        #description{
            margin-top:2px;
            font-size:15px;
        }
        label{
            margin-top:35px;
        }
    
        div{
            margin-left:20px;
        }
        #exit{
            text-align:right;
            margin-left:75%;
        }
        p{
            text-align:center;
        }
        .input{
            font-size:40px;
        }
    
        #exit a{
            text-decoration:none;
            color:red;
            font-size:20px;
        }
    </style>
</head>
<body>
    <header>
        <h1 id="udemy">Udemy</h1>
        <p id="steps">Step 2 of 4</p>
    </header>
    
    <div>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "db_lms";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve the question from the database
        $questionQuery = "SELECT * FROM questions WHERE question_title = 'How about a working title?'";
        $questionResult = $conn->query($questionQuery);

        if ($questionResult->num_rows > 0) {
            $questionData = $questionResult->fetch_assoc();
            $questionId = $questionData['id'];
            $questionTitle = $questionData['question_title'];

            // Display the question dynamically
            echo "<h2>$questionTitle</h2>";
            }
        else {
            echo "Question not found.";
        }

        $conn->close();
        ?>
       <p>It's ok if you can't think of a good title now. You can change it later.</p>
       <form action="process_course.php" method="post">
    <label for="courseTitle">Enter Course Title:</label>
    <input type="text" id="courseTitle" name="courseTitle" required>

    

           <footer>
                <input type="hidden" name="prev_step" value="create2">
                <button type="submit">Continue</button>
            </footer>
        </form>
    </div>
</body>
</html>
