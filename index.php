<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centre for Defense Research and Development</title>
    <link rel="icon" href="./assets/images/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <script defer src="assets/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="assets/css/app.css">
    <style>
       body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #5a8dee;
        }

        .banner {
            color: #5a8dee;
            padding: 50px 20px;
            text-align: center;
        }

        .banner h1 {
            font-size: 36px;
            margin-bottom: 20px;
            margin-top: 50px;
            color: black;
        }

        .banner h2 {
            font-size: 30px;
            margin-bottom: 20px;
            color: black;
        }
        .banner-logo {
            display: block;
            max-width: 150px; /* Adjust size as needed */
            height: auto;
            float: left;
            margin-right: 20px; /* Space between logo and banner content */
            border-radius: 50px;
        }

        .banner button {
            background-color: blue;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .banner button:hover {
            background-color: white;
            color: #4CAF50;
            border: 2px solid #4CAF50;
        }


    </style>
</head>
<body>

    <div class="banner">
    <img src="./assets/images/logo.jpg" alt="Logo" class="banner-logo">
    <br>
    <img src="index.png" alt="Banner Image" class="banner-image">
    <br>
        <h1><b>Leave Management System</b></h1>
        <h2>Centre for Defence Research and Development</h2>
        <button onclick="getStarted()">Get Started</button>
    </div>

    <script>
   function getStarted() {
    window.location.href = "login.php";
}

</script>
</body>
</html>


