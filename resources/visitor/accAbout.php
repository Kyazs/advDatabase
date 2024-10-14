<?php
require_once '../../app/helpers.php';
auth();
?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>
    <title>ZCJ Visitor Management System</title>
    <style>
        * {
            font-family: 'Quicksand', sans-serif;
        }

        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            background-color: #ffffff;
        }

        .container {
            display: flex;
            height: 100%;
        }

        .sidebar {
            background-color: #254C79;
            width: 250px; /* Sidebar width remains unchanged */
            padding: 20px;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar img {
            width: 80px;
            height: auto;
            margin-bottom: 20px;
        }

        .sidebar h3 {
            color: white;
            margin: 0 0 20px 0;
            text-align: center;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            width: 100%;
            text-align: center;
        }

        .sidebar a:hover {
            background-color: #B26D31;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
            background-color: #f9f9f9;
        }

        h2 {
            color: #254C79;
            margin-bottom: 20px;
            text-align: center;
            font-size: 30px;
        }

        .about-info {
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin: 20px auto;
            max-width: 600px;
        }

        .about-info h3 {
            color: #254C79;
            margin-bottom: 15px;
        }

        .about-info p {
            margin: 10px 0;
            text-align: justify;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <img src="../../assets/images/ZCJ-logo.png" alt="ZCJ Logo">
            <h3>ZCJ Visitor Management System</h3>
            <a href="../../resources/visitor/accDashboard.php">Dashboard</a>
            <a href="../../resources/visitor/accQR.php">QR Code</a>
            <a href="../../resources/visitor/accProfile.php">Profile</a>
            <a href="../../resources/visitor/accContact.php">Contact Us</a>
            <a href="../../resources/visitor/accAbout.php">About Us</a>
            <a href="../../public/index.php">Logout</a>
        </div>
        
        <div class="main-content">
            <h2>ABOUT US</h2>
            <div class="about-info">
                <p>The <strong>Zamboanga City Jail Visitor Management System</strong> (ZCJ-VMS) is a system created to improve the visitation process for inmates and their families at Zamboanga City Jail. Our goal is to make visits easier and more efficient while ensuring safety and security.

                </p>
                <p>At ZCJ-VMS, we believe in the importance of keeping families connected during incarceration. Our mission is to support these connections, which can lead to better outcomes for both inmates and the community. By using technology, we aim to streamline the visitation process and enhance security.</p>
            </div>
        </div>
    </div>
</body>
</html>
