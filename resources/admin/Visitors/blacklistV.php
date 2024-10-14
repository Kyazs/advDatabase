<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>
    <title>ZCJ Visitor Management System - Blacklisted Visitors</title>
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

        .qr-code, .id-photo {
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

        /* Button styles */
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

        .remove-blacklist {
            background-color: #8B0000; /* Set the background color to red */
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%; /* Full width */
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
            <h2>BLACKLISTED VISITORS</h2>
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
                        <th>Reason</th> <!-- Added Reason Column -->
                        <th>Action</th> <!-- Updated Action Column -->
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
                        <td>Misconduct</td>
                        <td>
                            <button class="view-details" data-id="1" data-qr="path/to/qr1.png" data-id-photo="path/to/id1.jpg">View Details</button>
                            <button class="remove-blacklist" data-id="1">Remove from Blacklist</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Doe</td>
                        <td>JaneD</td>
                        <td>02/02/2001</td>
                        <td>Female</td>
                        <td>09876543210</td>
                        <td>jane.doe@gmail.com</td>
                        <td>Village B, Lunzuran, Zamboanga City, Zamboanga Del Sur, Philippines</td>
                        <td>Violation</td>
                        <td>
                            <button class="view-details" data-id="2" data-qr="path/to/qr2.png" data-id-photo="path/to/id2.jpg">View Details</button>
                            <button class="remove-blacklist" data-id="2">Remove from Blacklist</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Popup for Visitor Details -->
    <div class="popup" id="details-popup">
        <div class="popup-content">
            <span class="close-btn" id="close-popup">&times;</span>
            <h2>Visitor Details</h2>
            <p class="section-heading">QR Code:</p>
            <img src="" alt="QR Code" class="qr-code" id="visitor-qr-code">
            <p class="section-heading">Valid ID Photo:</p>
            <img src="" alt="ID Photo" class="id-photo" id="visitor-id-photo">
        </div>
    </div>

    <script>
        // Toggle submenu visibility
        document.querySelectorAll('.toggle-visitors, .toggle-visitlogs, .toggle-reports').forEach(item => {
            item.addEventListener('click', event => {
                const submenu = item.nextElementSibling;
                submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
                const arrow = item.querySelector('.arrow');
                arrow.style.transform = submenu.style.display === 'block' ? 'rotate(90deg)' : 'rotate(0deg)';
            });
        });

        // Show details popup
        document.querySelectorAll('.view-details').forEach(button => {
            button.addEventListener('click', event => {
                const id = button.dataset.id;
                const qr = button.dataset.qr;
                const idPhoto = button.dataset.idPhoto;

                // Set the src attributes for QR code and ID photo
                document.getElementById('visitor-qr-code').src = qr;
                document.getElementById('visitor-id-photo').src = idPhoto;

                // Show the popup
                document.getElementById('details-popup').style.display = 'flex';
            });
        });

        // Close the popup
        document.getElementById('close-popup').addEventListener('click', () => {
            document.getElementById('details-popup').style.display = 'none';
        });

        // Search Function
        document.getElementById('search-input').addEventListener('input', function() {
            const query = this.value.toLowerCase();
            const rows = document.querySelectorAll('#visitors-table tbody tr');
            rows.forEach(row => {
                const cells = row.getElementsByTagName('td');
                const name = cells[1].textContent.toLowerCase();
                const username = cells[2].textContent.toLowerCase();
                const reason = cells[8].textContent.toLowerCase();
                if (name.includes(query) || username.includes(query) || reason.includes(query)) {
                    row.style.display = ''; // Show the row
                } else {
                    row.style.display = 'none'; // Hide the row
                }
            });
        });

        // Sort Function
        document.getElementById('sort-select').addEventListener('change', function() {
            const table = document.getElementById('visitors-table');
            const tbody = table.tBodies[0];
            const rows = Array.from(tbody.rows);
            const sortOrder = this.value === 'newest';

            rows.sort((a, b) => {
                const idA = parseInt(a.cells[0].textContent);
                const idB = parseInt(b.cells[0].textContent);
                return sortOrder ? idB - idA : idA - idB; // Newest first or oldest first
            });

            // Append the sorted rows back to the tbody
            rows.forEach(row => tbody.appendChild(row));
        });
    </script>
</body>
</html>
