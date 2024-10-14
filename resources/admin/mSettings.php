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
            position: relative;
            align-items: center;
        }

        .sidebar img {
            width: 80px;
            height: auto;
            margin-bottom: 20px;
            display: block;
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
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

        .submenu {
            font-size: 14px;
            margin-left: 20px;
            display: none;
            padding: 0; /* Prevents additional padding affecting layout */
        }

        .submenu a {
            text-align: left;
            padding-left: 30px;
            color: white;
        }

        .submenu a:hover {
            background-color: #B26D31;
            color: white;
        }

        .arrow {
            font-size: 12px;
            transition: transform 0.3s ease;
        }

        .active .arrow {
            transform: rotate(90deg);
        }

        .active-down .arrow {
            transform: rotate(180deg);
        }

        .sidebar {
            height: 100%;
            overflow-y: auto;
        }

        .sidebar .bottom-section {
            margin-top: auto;
            text-align: center;
        }

    </style>
</head>
<body>
    <div class="container">
    <div class="sidebar">
            <img src="../../assets/images//ZCJ-logo.png" alt="ZCJ Logo">
            <h3>ZCJ Visitor Management System</h3>
            <a href="../admin/mDashboard.php">Dashboard</a>

            <a href="javascript:void(0);" class="toggle-visitors">Visitors <span class="arrow">&#9654;</span></a>
            <div class="submenu submenu-visitors">
                <a href="../admin/Visitors/allV.php">Registered Visitors</a>
                <a href="../admin/Visitors/pendingV.php">Pending Visitors</a>
                <a href="../admin/Visitors/blacklistV.php">Blacklisted Visitors</a>
            </div>

            <a href="javascript:void(0);" class="toggle-visitlogs">Visit Logs <span class="arrow">&#9654;</span></a>
            <div class="submenu submenu-visitlogs">
                <a href="../admin/Visit Logs/vpending.php">Pending Visits</a>
                <a href="../admin/Visit Logs/currentV.php">Ongoing Visits</a>
                <a href="../admin/Visit Logs/historyV.php">Completed Visits</a>
            </div>

            <a href="javascript:void(0);" class="toggle-reports">Reports and Analytics <span class="arrow">&#9654;</span></a>
            <div class="submenu submenu-reports">
                <a href="../admin/Reports/dailyV.php">Daily Visitor</a>
                <a href="../admin/Reports/weeklyV.php">Weekly Visitor</a>
                <a href="../admin/Reports/monthlyV.php">Monthly Visitor</a>
            </div>

            <a href="../admin/mSettings.php">Settings</a>
            <a href="../../public/index.php">Logout</a>

            <div class="bottom-section">
                <br><br><br><br><br><br><br><br><br><br><br><br>
                <h3>Moderator</h3>
            </div>
        </div>

        <div class="main-content">
            <h2>SETTINGS</h2>
        </div>
    </div>

    <script>
        document.querySelector('.toggle-visitors').addEventListener('click', function() {
            var submenuVisitors = document.querySelector('.submenu-visitors');
            var arrowVisitors = document.querySelector('.toggle-visitors .arrow');

            submenuVisitors.style.display = submenuVisitors.style.display === "block" ? "none" : "block";
            arrowVisitors.style.transform = submenuVisitors.style.display === "block" ? "rotate(180deg)" : "rotate(0deg)";
        });

        document.querySelector('.toggle-visitlogs').addEventListener('click', function() {
            var submenuVisitLogs = document.querySelector('.submenu-visitlogs');
            var arrowVisitLogs = document.querySelector('.toggle-visitlogs .arrow');

            submenuVisitLogs.style.display = submenuVisitLogs.style.display === "block" ? "none" : "block";
            arrowVisitLogs.style.transform = submenuVisitLogs.style.display === "block" ? "rotate(180deg)" : "rotate(0deg)";
        });

        document.querySelector('.toggle-reports').addEventListener('click', function() {
            var submenuReports = document.querySelector('.submenu-reports');
            var arrowReports = document.querySelector('.toggle-reports .arrow');

            submenuReports.style.display = submenuReports.style.display === "block" ? "none" : "block";
            arrowReports.style.transform = submenuReports.style.display === "block" ? "rotate(180deg)" : "rotate(0deg)";
        });
    </script>
</body>
</html>
