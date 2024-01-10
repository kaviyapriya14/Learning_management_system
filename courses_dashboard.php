<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Creation</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        
        }

        div {
            max-width: 1000px;
            width: 100%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            text-align: left;
            display: inline-block;
            margin-right: 20px; 
        }

        form {
            margin-top: 0;
            text-align: right;
            display: inline-block;
            width: 30%; 
            margin-left:350px;
        }

        button {
            background-color: purple;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            
        }

        button:hover {
         background-color:rgb(222, 11, 222);
        }

    </style>
</head>
<body>
    <div>
        <h2>Jump into Course Creation</h2>
        
        <form action="create1.php" method="post">
            <button type="submit">Create Your Course</button>

        </form>

    </div>

</body>
</html>
