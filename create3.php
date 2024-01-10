<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create3</title>
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
            align-items: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
            border: 1px solid #333;
            border-radius: 0;
            padding: 10px;
            width: 40%;
            box-sizing: border-box;
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
        #selected_option{
            font-size:30px;
            margin-top:30px;
            margin-left:35px;

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
        div{
            margin-left:20px;
        }
        #exit{
            text-align:right;
            margin-left:75%;
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
        <p id="steps">Step 3 of 4</p>
        <div id="exit">
        <a href="teach_on_udemy_dashboard.php">Exit</a></div>
    </header>
    <form action="process_course1.php" method="post">
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

                // Query to retrieve the question and its options
                $questionQuery = "SELECT * FROM questions WHERE status = 'active' LIMIT 5,1";
                $questionResult = $conn->query($questionQuery);

                if ($questionResult->num_rows > 0) {
                    $questionData = $questionResult->fetch_assoc();
                    $questionId = $questionData['id'];
                    $questionTitle = $questionData['question_title'];
                }
                    // Display the question title
                    echo "<h2>$questionTitle</h2>";
                    
                   
            ?>
                <p id="description">If you're not sure about the right category, you can change it later.</p>

                <select id="category" name="categoryId" required>
        <option value="1">Finance & Accounting</option>
        <option value="2">IT & Software</option>
        <option value="3">Office Productivity</option>
        <option value="4"> personal development</option>
        <option value="5">Design</option>
        <option value="6">Marketing</option>
        <option value="7">Life style</option>
        <option value="8">Photography & Video</option>
        <option value="9">Health & Fitness</option>
        <option value="10">Music</option>
        <option value="11">Teaching and Academics</option>
        <option value="12">I don't know yet</option>    
    
    </select>

    
        </div>
        
        <footer>
            <input type="hidden" name="prev_step" value="create3">
            <button type="submit">Continue</button>
        </footer>
    </form>
</body>
</html>