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
            width: 250px;
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
            font-size:30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #254C79;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #254C79;
            color: white;
        }

        .button {
            background-color: #B26D31;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1rem;
            font-family: 'Quicksand', sans-serif;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            margin-top: 20px;
            display: inline-block;
        }

        .button:hover {
            background-color: #a05e2f;
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
            <a href="../../app/validation/logout.php">Logout</a>

        </div>
        
        <div class="main-content">
            <h2>DASHBOARD</h2>
            <div id="visiting-logs">
                <h3>Visiting Logs</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Inmate ID</th>
                            <th>Inmate Name</th>
                            <th>Check-in Time</th>
                            <th>Check-out Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2024-09-01</td>
                            <td>1</td>
                            <td>Theris Carroz</td>
                            <td>10:00 AM</td>
                            <td>12:00 PM</td>
                        </tr>
                        <tr>
                            <td>2024-09-01</td>
                            <td>2</td>
                            <td>Theris Carroz</td>
                            <td>10:00 AM</td>
                            <td>12:00 PM</td>
                        </tr>
                        <tr>
                            <td>2024-09-01</td>
                            <td>3</td>
                            <td>Theris Carroz</td>
                            <td>10:00 AM</td>
                            <td>12:00 PM</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
