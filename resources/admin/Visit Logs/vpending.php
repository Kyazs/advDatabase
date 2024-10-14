<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>
    <title>ZCJ Visitor Management System - Pending Visits</title>
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
            width: 200px;
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
            text-align: center;
        }

        .close-btn {
            cursor: pointer;
            color: #254C79;
            float: right;
            font-size: 20px;
        }

        .id-photo {
            margin-top: 15px;
            max-width: 100%;
            height: auto;
            display: block;
        }

        /* New heading styles */
        .section-heading {
            margin-top: 10px;
            font-weight: bold;
            color: #254C79;
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

        .confirm {
            background-color: #006400; /* Dark green color */
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%; /* Full width */
        }

        .decline {
            background-color: #8B0000; /* Dark green color */
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%; /* Full width */
            margin-top: 5px;
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
            <h2>PENDING VISITS</h2>
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
                        <th>Full Name</th>
                        <th>Username</th> <!-- Added Username Column -->
                        <th>Birthdate</th>
                        <th>Gender</th>
                        <th>Contact Number</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>John Casper Santos</td>
                        <td>Kyazs</td>
                        <td>01/01/2000</td>
                        <td>Male</td>
                        <td>09123456789</td>
                        <td>john.casper@gmail.com</td>
                        <td>Village A, Lunzuran, Zamboanga City, Zamboanga Del Sur, Philippines</td>
                        <td>
                            <button class="view-details" data-id="1">View Details</button>
                            <button class="confirm" data-id="1">Confirm</button>
                            <button class="decline" data-id="3">Decline</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Kathryn Bernardo</td>
                        <td>k_bernardo</td>
                        <td>02/14/1995</td>
                        <td>Female</td>
                        <td>09123456780</td>
                        <td>kathryn.bernardo@gmail.com</td>
                        <td>Village B, Zamboanga City, Zamboanga Del Sur, Philippines</td>
                        <td>
                            <button class="view-details" data-id="1">View Details</button>
                            <button class="confirm" data-id="2">Confirm</button>
                            <button class="decline" data-id="3">Decline</button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Daniel Padilla</td>
                        <td>danielpadilla</td>
                        <td>04/26/1996</td>
                        <td>Male</td>
                        <td>09123456781</td>
                        <td>daniel.padilla@gmail.com</td>
                        <td>Village C, Zamboanga City, Zamboanga Del Sur, Philippines</td>
                        <td>
                            <button class="view-details" data-id="1">View Details</button>
                            <button class="confirm" data-id="3">Confirm</button>
                            <button class="decline" data-id="3">Decline</button>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Marian Rivera</td>
                        <td>marianr</td>
                        <td>06/19/1986</td>
                        <td>Female</td>
                        <td>09123456782</td>
                        <td>marian.rivera@gmail.com</td>
                        <td>Village D, Zamboanga City, Zamboanga Del Sur, Philippines</td>
                        <td>
                            <button class="view-details" data-id="1">View Details</button>
                            <button class="confirm" data-id="4">Confirm</button>
                            <button class="decline" data-id="3">Decline</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Popup for ID View -->
    <div class="popup" id="popup">
        <div class="popup-content">
            <span class="close-btn" id="close-popup">&times;</span>
            <h2>QR Code</h2>
            <img src="" alt="QR Code" class="qr-code" id="qr-code">
            <h2>Valid ID</h2>
            <img src="" alt="Valid ID" class="id-photo" id="id-photo">
        </div>
    </div>

    <script>
        // JavaScript for search and sort functionality
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search-input');
            const sortSelect = document.getElementById('sort-select');
            const visitorsTable = document.getElementById('visitors-table').getElementsByTagName('tbody')[0];
    
            // Function to filter visitors based on search input
            function filterVisitors() {
                const searchTerm = searchInput.value.toLowerCase();
                const rows = visitorsTable.getElementsByTagName('tr');
    
                Array.from(rows).forEach(row => {
                    const cells = row.getElementsByTagName('td');
                    let rowVisible = false;
    
                    for (let i = 1; i < cells.length - 1; i++) { // Start from 1 to skip ID column and end column
                        const cellValue = cells[i].textContent.toLowerCase();
                        if (cellValue.includes(searchTerm)) {
                            rowVisible = true;
                            break;
                        }
                    }
    
                    row.style.display = rowVisible ? '' : 'none';
                });
            }
    
            // Function to sort visitors based on selected option
            function sortVisitors() {
                const rows = Array.from(visitorsTable.getElementsByTagName('tr'));
                const sortValue = sortSelect.value;
    
                rows.sort((a, b) => {
                    const aId = parseInt(a.cells[0].textContent);
                    const bId = parseInt(b.cells[0].textContent);
                    return sortValue === 'newest' ? bId - aId : aId - bId;
                });
    
                // Append sorted rows back to the table
                rows.forEach(row => visitorsTable.appendChild(row));
            }
    
            // Event listeners
            searchInput.addEventListener('input', () => {
                filterVisitors();
                sortVisitors();
            });
    
            sortSelect.addEventListener('change', () => {
                sortVisitors();
            });
    
            // Popup functionality for viewing valid IDs
            const popup = document.getElementById('popup');
            const idPhoto = document.getElementById('id-photo');
            const closePopup = document.getElementById('close-popup');
    
            // Updated this part to use the correct class and get the ID dynamically
            document.querySelectorAll('.view-details').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    // Load the image based on ID (placeholder path)
                    idPhoto.src = `path/to/valid-id-${id}.jpg`; // Change this path as needed
                    popup.style.display = 'flex';
                });
            });
    
            closePopup.addEventListener('click', function () {
                popup.style.display = 'none';
            });
    
            window.addEventListener('click', function (event) {
                if (event.target === popup) {
                    popup.style.display = 'none';
                }
            });
    
            // Sidebar functionality
            const toggleVisitors = document.querySelector('.toggle-visitors');
            const submenuVisitors = document.querySelector('.submenu-visitors');
    
            toggleVisitors.addEventListener('click', function () {
                submenuVisitors.style.display = submenuVisitors.style.display === 'none' || submenuVisitors.style.display === '' ? 'block' : 'none';
                this.querySelector('.arrow').style.transform = submenuVisitors.style.display === 'block' ? 'rotate(90deg)' : 'rotate(0deg)';
            });
    
            const toggleVisitLogs = document.querySelector('.toggle-visitlogs');
            const submenuVisitLogs = document.querySelector('.submenu-visitlogs');
    
            toggleVisitLogs.addEventListener('click', function () {
                submenuVisitLogs.style.display = submenuVisitLogs.style.display === 'none' || submenuVisitLogs.style.display === '' ? 'block' : 'none';
                this.querySelector('.arrow').style.transform = submenuVisitLogs.style.display === 'block' ? 'rotate(90deg)' : 'rotate(0deg)';
            });
    
            const toggleReports = document.querySelector('.toggle-reports');
            const submenuReports = document.querySelector('.submenu-reports');
    
            toggleReports.addEventListener('click', function () {
                submenuReports.style.display = submenuReports.style.display === 'none' || submenuReports.style.display === '' ? 'block' : 'none';
                this.querySelector('.arrow').style.transform = submenuReports.style.display === 'block' ? 'rotate(90deg)' : 'rotate(0deg)';
            });
        });
    </script>
</body>
</html>
