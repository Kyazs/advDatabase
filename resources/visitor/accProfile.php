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
            font-size: 30px;
        }

        .profile-info {
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin: 20px auto;
            max-width: 600px;
        }

        .profile-info h3 {
            color: #254C79;
            margin-bottom: 15px;
        }

        .profile-info p {
            margin: 10px 0;
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
            <h2>PROFILE</h2>
            <div class="profile-info">
                <h3>Personal Information</h3>
                <p><strong>First Name:</strong> John Casper</p>
                <p><strong>Last Name:</strong> Santos</p>
                <p><strong>Middle Name:</strong> G.</p>
                <p><strong>Contact Number:</strong> 09123456789</p>
                <p><strong>Birthdate:</strong> 01/01/2000</p>
                <p><strong>Email:</strong> john.casper@gmail.com</p>
                <p><strong>Gender:</strong> Male</p>
            </div>
            
            <div class="profile-info">
                <h3>Address</h3>
                <p><strong>Country:</strong> Philippines</p>
                <p><strong>Province:</strong> Zamboanga Del Sur</p>
                <p><strong>City:</strong> Zamboanga City</p>
                <p><strong>Barangay:</strong> Lunzuran</p>
                <p><strong>Building No./Village:</strong> Village A</p>
            </div>
            
            <div class="profile-info">
                <h3>Account Information</h3>
                <p><strong>Username:</strong> Kyazs</p>
                <p><strong>Email Address:</strong> john.casper@gmail.com</p>
            </div>
        </div>
    </div>
</body>
</html>
