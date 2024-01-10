<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learning Management System</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('homepage.png');
            background-size: 1400px;
            color: #333;
        }

        header {
            background-color: white;
            padding: 1em;
            text-align: center;
            color: black;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo h1 {
            color: black;
            margin-left: 10px;
        }

        .search-bar {
            flex: 1;
            margin: 0 20px;
            position: relative;
        }

        .search-bar input {
            width: 70%;
            padding: 8px 30px 8px 10px;
            border: 1px solid #ddd;
            border-radius: 100px;
            background-size: 20px;
        }

        .login-signup-buttons {
            display: flex;
            gap: 10px;
        }

        .login-buttons button {
            padding: 8px;
            border: none;
            border-radius: 4px;
            background-color: white;
            color: black;
            cursor: pointer;
            border-style:solid;
            border-color:black;
            border-width:1px;
            margin-right:10px;
        }

        .signup-buttons button{
            padding: 8px;
            border: none;
            border-radius: 4px;
            background-color: red;
            color: black;
            cursor: pointer;
            border-style:solid;
            border-color:black;
            border-width:1px;


        }

        .login-buttons button a,
        .signup-buttons button a {
            color: black;
            text-decoration: none; 
        }

        .login-buttons button:hover,
        .signup-buttons button:hover {
            background-color: #ddd; 
        }
        h1 {
            color: black;
            display: flex;
            align-items: center;
        }

        h1::before {
            content: '\1F393';
            margin-right: 10px;
            font-size: 1.5em;
        }

        .carousel img {
            width: 100%;
            border-radius: 1px;
        }

        footer {
            background-color: purple;
            color: white;
            text-align: center;
            padding: 1em 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>

    <header>
        <div class="logo">
            <h1>Udemy</h1>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="&#128269; Search courses...">
        </div>
        <div class="login-buttons">
            <button><a href="Login.php">Login</a></button>
        </div>
        <div class="signup-buttons">
            <button><a href="Register.php">Signup</a></button>
    </div>
    </header>

    <footer>
        &copy; 2023 Learning Management System
    </footer>

</body>

</html>