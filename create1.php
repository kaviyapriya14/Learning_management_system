<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create1</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
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

        #heading {
            font-size:35px;
            font-family:"font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif";
        }

        #description {
            margin-top:2px;
            font-size:15px;
        }

        div {
            margin-left:20px;
        }

        #exit {
            text-align:right;
            margin-left:75%;
        }

        #exit a {
            text-decoration:none;
            color:red;
            font-size:20px;
        }
    </style>
</head>
<body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <header>
        <h1 id="udemy">Udemy</h1>
        <p id="steps">Step 1 of 4</p>
        <div id="exit">
            <a href="teach_on_udemy_dashboard.php">Exit</a>
        </div>
    </header>

        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "db_lms";
            
            $conn = new mysqli($servername, $username, $password, $database);
            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Query to retrieve the fourth question and its options
            $fourthQuestionQuery = "SELECT * FROM questions WHERE status = 'active' LIMIT 1 OFFSET 3";
            $fourthQuestionResult = $conn->query($fourthQuestionQuery);

            if ($fourthQuestionResult->num_rows > 0) {
                $fourthQuestionData = $fourthQuestionResult->fetch_assoc();
                $fourthQuestionId = $fourthQuestionData['id'];
                $fourthQuestionTitle = $fourthQuestionData['question_title'];

                // Query to retrieve options for the fourth question
                $fourthOptionsQuery = "SELECT * FROM answers WHERE question_id = $fourthQuestionId AND status = 'active'";
                $fourthOptionsResult = $conn->query($fourthOptionsQuery);
        ?>
                <h2><?php echo $fourthQuestionTitle; ?></h2>

                <form action="save-result.php" method="post" onsubmit="return validateForm()">
                    <?php
                        if ($fourthOptionsResult->num_rows > 0) {
                            while ($fourthOption = $fourthOptionsResult->fetch_assoc()) {
                                $fourthOptionId = $fourthOption['id'];
                                $fourthOptionTitle = $fourthOption['answer_title'];
                    ?>
                                    <label>
                                        <input type="radio" name="selected_option" value="<?php echo $fourthOptionId; ?>">
                                        <?php echo $fourthOptionTitle; ?>
                                    </label>
                    <?php
                            }
                        }
                    ?>
                    
                    <!-- Additional hidden input to identify the question in save-result.php -->
                    <input type="hidden" name="question_id" value="<?php echo $fourthQuestionId; ?>">
                    <input type="hidden" name="prev_step" value="create1">

                    <!-- Move the submit button to the footer -->
                    <footer>
                        <button type="submit">Continue</button>
                    </footer>
                </form>
        <?php
            }
        ?>
    </div>
    <script src="teach_exp.js"></script>
</body>
</html>
