<!DOCTYPE html>
<html>
<head>
    <title>Teach on Udemy Dashboard</title>
</head>
<body>
    <header>
        <div class="logo">
            <h1>Udemy</h1>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="&#128269; Search courses...">
        </div>
        <div class="home-button">
            <button><a href="Home.php">Home</a></button>
        </div>
    </header>

    <div class="hero-section">
        <div class="overlay-text">
            <h2 style="font-family: 'Times New Roman', Times, serif";>Come teach <br>with Us</h2>
            <p>Become a instructor and change<br>lives-including your own</p>
            <a href="teaching_experience.php" class="cta-button">Get Started</a>
        </div>
    </div>
</body>
</html>

<style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-image: url('teach_on_udemy_dashboard.jpg');
        background-size: cover;
        color: #333;
        position: relative; 
        
    }

    header {
        background-color: white;
        padding: 1em;
        text-align: center;
        color: black;
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 2; 
    }

    .logo {
        display: flex;
        align-items: center;
    }

    .logo h1 {
        color: black;
        margin-left: 10px;
    }
    h1::before {
            content: '\1F393';
            margin-right: 10px;
            font-size: 1.5em;
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

    .hero-section {
        position: relative;
        height: 90vh; 
        display: flex;
        align-items: center;
        justify-content: flex-start; 
        margin-left:150px;
        margin-top:0px;
    }

    .overlay-text {
        position: absolute;
        top: 50%;
        left: 10%; 
        transform: translate(-50%, -50%);
        text-align: left;
        color:black;
        z-index: 1; 
    }

    .overlay-text h2 {
        font-size: 3.5em;
        margin-bottom: 10px;
    }

    .overlay-text p {
        font-size: 1.2em;
        margin-bottom: 20px;
    }

    .cta-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #ff4500;
        color: white;
        text-decoration: none;
        border-radius: 0px;
        font-weight: bold;
        width:200px;
        text-align:center;
    }
</style>
