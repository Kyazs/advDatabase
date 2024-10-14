<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>
    <title>ZCJ Visitor Management System - Ongoing Visits</title>
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
            min-height: 100vh;
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
            height: auto;
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

        .submenu {
            font-size: 14px;
            margin-left: 20px;
            display: none;
            padding: 0;
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

        .search-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        input[type="text"] {
            width: 200px; /* Set the width of the search input */
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        select {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-left: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border-radius: 10px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #254C79;
            color: white;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        /* Popup styles */
        .popup {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            max-width: 500px;
            width: 100%;
            text-align: left; /* Align text to the left in popup */
        }

        .close-btn {
            cursor: pointer;
            color: #254C79;
            float: right;
            font-size: 20px;
        }

        .qr-code {
            margin-bottom: 15px;
            max-width: 100%; /* Ensure QR code image fits within the popup */
            height: auto;
            display: block; /* Ensure it's block level for proper alignment */
        }

        .view-details {
            background-color: #B26D31; /* Set the background color to orange */
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%; /* Full width */
            margin-bottom: 5px; /* Space between buttons */
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <img src="../ZCJ-logo.png" alt="ZCJ Logo">
            <h3>ZCJ Visitor Management System</h3>
            <a href="../Account/mDashboard.html">Dashboard</a>
            <a href="javascript:void(0);" class="toggle-visitors">Visitors <span class="arrow">&#9654;</span></a>
            <div class="submenu submenu-visitors">
                <a href="../Visitors/allV.html">Registered Visitors</a>
                <a href="../Visitors/pendingV.html">Pending Visitors</a>
                <a href="../Visitors/blacklistV.html">Blacklisted Visitors</a>
            </div>
            <a href="javascript:void(0);" class="toggle-visitlogs">Visit Logs <span class="arrow">&#9654;</span></a>
            <div class="submenu submenu-visitlogs">
                <a href="../Visit Logs/vpending.html">Pending Visits</a>
                <a href="../Visit Logs/currentV.html">Ongoing Visits</a>
                <a href="../Visit Logs/historyV.html">Completed Visits</a>
            </div>
            <a href="javascript:void(0);" class="toggle-reports">Reports and Analytics <span class="arrow">&#9654;</span></a>
            <div class="submenu submenu-reports">
                <a href="../Reports/dailyV.html">Daily Visitor</a>
                <a href="../Reports/weeklyV.html">Weekly Visitor</a>
                <a href="../Reports/monthlyV.html">Monthly Visitor</a>
            </div>
            <a href="../Account/mSettings.html">Settings</a>
            <a href="../Login/login.html">Logout</a>
            <div class="bottom-section">
                <br><br><br><br><br><br><br><br><br><br><br><br>
                <h3>Moderator</h3>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h2>ONGOING VISITS</h2>
            <div class="search-container">
                <input type="text" id="search-input" placeholder="Search for visitors...">
                <select id="sort-select">
                    <option value="Sort">Sort By</option>
                    <option value="newest">Newest First</option>
                    <option value="oldest">Oldest First</option>
                </select>
            </div>
            <table id="visitors-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Visitor Name</th>
                        <th>Inmate Name</th>
                        <th>Relationship</th>
                        <th>Time-In</th>
                        <th>Time-Out</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>John Casper Santos</td>
                        <td>Theris Eldrene Carroz</td>
                        <td>Friend</td>
                        <td>10:00 AM</td>
                        <td></td>
                        <td>10-10-2024</td>
                        <td><button class="view-details" data-id="1">View Details</button></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Kathryn Bernardo</td>
                        <td>Daniel Padilla</td>
                        <td>Ex</td>
                        <td>09:00 AM</td>
                        <td></td>
                        <td>10-09-2024</td>
                        <td><button class="view-details" data-id="2">View Details</button></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Michael Jordan</td>
                        <td>Michael Jackson</td>
                        <td>Friend</td>
                        <td>08:00 AM</td>
                        <td></td>
                        <td>10-08-2024</td>
                        <td><button class="view-details" data-id="3">View Details</button></td>
                    </tr>
                </tbody>
            </table>

            <!-- Popup for visitor details -->
            <div class="popup" id="popup">
                <div class="popup-content">
                    <span class="close-btn" id="close-popup">&times;</span>
                    <h3>Visitor Details</h3>
                    <div id="visitor-details"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Visitor data
        const visitorsData = {
            1: {
                firstName: "John Casper",
                middleName: "G.",
                lastName: "Santos",
                birthdate: "01/01/2000",
                gender: "Male",
                contactNumber: "09123456789",
                email: "john.casper@gmail.com",
                address: "Village A, Lunzuran, Zamboanga City, Zamboanga Del Sur, Philippines",
                qrCode: "../QR.svg" // Update this with the correct path
            },
            2: {
                firstName: "Kathryn",
                middleName: "L.",
                lastName: "Bernardo",
                birthdate: "05/01/1995",
                gender: "Female",
                contactNumber: "09234567890",
                email: "kathryn.bernardo@gmail.com",
                address: "Village B, Zamboanga City, Zamboanga Del Sur, Philippines",
                qrCode: "../QR.svg" // Update this with the correct path
            },
            3: {
                firstName: "Michael",
                middleName: "J.",
                lastName: "Jordan",
                birthdate: "03/15/1992",
                gender: "Male",
                contactNumber: "09345678901",
                email: "michael.jordan@gmail.com",
                address: "Village C, Zamboanga City, Zamboanga Del Sur, Philippines",
                qrCode: "../QR.svg" // Update this with the correct path
            }
        };

        // Sidebar toggle functionality
        const toggleVisitors = document.querySelector('.toggle-visitors');
        const submenuVisitors = document.querySelector('.submenu-visitors');

        toggleVisitors.addEventListener('click', () => {
            submenuVisitors.style.display = submenuVisitors.style.display === 'none' ? 'block' : 'none';
            toggleVisitors.querySelector('.arrow').style.transform = submenuVisitors.style.display === 'block' ? 'rotate(90deg)' : 'rotate(0deg)';
        });

        const toggleVisitLogs = document.querySelector('.toggle-visitlogs');
        const submenuVisitLogs = document.querySelector('.submenu-visitlogs');

        toggleVisitLogs.addEventListener('click', () => {
            submenuVisitLogs.style.display = submenuVisitLogs.style.display === 'none' ? 'block' : 'none';
            toggleVisitLogs.querySelector('.arrow').style.transform = submenuVisitLogs.style.display === 'block' ? 'rotate(90deg)' : 'rotate(0deg)';
        });

        const toggleReports = document.querySelector('.toggle-reports');
        const submenuReports = document.querySelector('.submenu-reports');

        toggleReports.addEventListener('click', () => {
            submenuReports.style.display = submenuReports.style.display === 'none' ? 'block' : 'none';
            toggleReports.querySelector('.arrow').style.transform = submenuReports.style.display === 'block' ? 'rotate(90deg)' : 'rotate(0deg)';
        });

        // Search functionality
        document.getElementById('search-input').addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#visitors-table tbody tr');
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const name = cells[1].textContent.toLowerCase();
                row.style.display = name.includes(filter) ? '' : 'none';
            });
        });

        // Sort functionality
        document.getElementById('sort-select').addEventListener('change', function() {
            const rows = Array.from(document.querySelectorAll('#visitors-table tbody tr'));
            const order = this.value === 'newest' ? 1 : -1;
            rows.sort((a, b) => order * (Number(a.cells[0].textContent) - Number(b.cells[0].textContent)));
            const tbody = document.querySelector('#visitors-table tbody');
            tbody.innerHTML = '';
            rows.forEach(row => tbody.appendChild(row));
        });

        // Popup functionality
        const popup = document.getElementById('popup');
        const closePopup = document.getElementById('close-popup');

        document.querySelectorAll('.view-details').forEach(button => {
            button.addEventListener('click', function() {
                const visitorId = this.getAttribute('data-id');
                const visitor = visitorsData[visitorId];
                
                const visitorDetails = `
                    <img src="${visitor.qrCode}" alt="${visitor.firstName} QR Code" class="qr-code"><br>
                    <strong>Personal Information:</strong><br>
                    First Name: ${visitor.firstName}<br>
                    Middle Name: ${visitor.middleName}<br>
                    Last Name: ${visitor.lastName}<br>
                    Birthdate: ${visitor.birthdate}<br>
                    Gender: ${visitor.gender}<br>
                    Contact Number: ${visitor.contactNumber}<br>
                    Email: ${visitor.email}<br>
                    Address: ${visitor.address}<br><br>
                    <strong>Visit Details:</strong><br>
                    ID: ${visitorId}<br>
                    Name: ${this.closest('tr').cells[1].textContent}<br>
                    Inmate: ${this.closest('tr').cells[2].textContent}<br>
                    Relationship: ${this.closest('tr').cells[3].textContent}<br>
                    Time-In: ${this.closest('tr').cells[4].textContent}<br>
                    Time-Out: ${this.closest('tr').cells[5].textContent}<br>
                    Date: ${this.closest('tr').cells[6].textContent}
                `;
                
                document.getElementById('visitor-details').innerHTML = visitorDetails;
                popup.style.display = 'flex';
            });
        });

        closePopup.addEventListener('click', () => {
            popup.style.display = 'none';
        });

        window.addEventListener('click', function(event) {
            if (event.target === popup) {
                popup.style.display = 'none';
            }
        });
    </script>
</body>
</html>
