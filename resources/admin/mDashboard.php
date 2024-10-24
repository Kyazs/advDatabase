
<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>
    <title>ZCJ Visitor Management System - Dashboard</title>
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

        .dashboard-stats {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }

        .stat-card {
            background-color: #254C79;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 350px;
            color: #ffffff;
        }

        .chart-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            gap: 10px;
        }

        .chart-box {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            width: 50%;
            height: 250px; /* Adjusted height for smaller charts */
        }

        .chart-box canvas {
            width: 100% !important; /* Make sure the canvas takes full width */
            height: auto !important; /* Set height to auto to keep aspect ratio */
            max-height: 200px; /* Set a max height to make the chart smaller */
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
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
<?php
include '../includes/sidebarAdmin.php';
?>

        <!-- Main Content -->
        <div class="main-content">
            <h2>DASHBOARD</h2>

            <!-- Dashboard Stats -->
            <div class="dashboard-stats">
                <div class="stat-card">
                    <h3 id="ongoing-visits">10</h3>
                    <p>Ongoing Visits</p>
                </div>
                <div class="stat-card">
                    <h3 id="completed-visits">10</h3>
                    <p>Completed Visits</p>
                </div>
                <div class="stat-card">
                    <h3>8</h3>
                    <p>Total Users</p>
                </div>
            </div>

            <!-- Charts -->
            <div class="chart-container">
                <div class="chart-box">
                    <h3>Visitor Status</h3>
                    <canvas id="statusChart"></canvas>
                </div>
                <div class="chart-box">
                    <h3>Today's Visitors</h3>
                    <canvas id="visitorsChart"></canvas>
                </div>
            </div>

            <h3>Visit Logs</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Visitor Name</th>
                        <th>Inmate Name</th>
                        <th>Relationship</th>
                        <th>Time-In</th>
                        <th>Time-Out</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>John Casper Santos</td>
                        <td>Theris Eldrene Carroz</td>
                        <td>Friend</td>
                        <td>10:00 AM</td>
                        <td>11:00 AM</td>
                        <td>10-10-2024</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Kathryn Bernardo</td>
                        <td>Daniel Padilla</td>
                        <td>Ex</td>
                        <td>09:00 AM</td>
                        <td>10:00 AM</td>
                        <td>10-09-2024</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Michael Jordan</td>
                        <td>Michael Jackson</td>
                        <td>Friend</td>
                        <td>08:30 AM</td>
                        <td>09:30 AM</td>
                        <td>10-08-2024</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Variables to track ongoing and completed visits
        const ongoingVisits = 10; // This value should be dynamically fetched or updated
        const completedVisits = 10; // This value should be dynamically fetched or updated

        // Display ongoing and completed visits in the dashboard stats
        document.getElementById('ongoing-visits').textContent = ongoingVisits;
        document.getElementById('completed-visits').textContent = completedVisits;

        // Set data for today's visitors based on ongoing and completed visits
        const checkedIn = ongoingVisits; // Checked-in visitors are ongoing visits
        const checkedOut = completedVisits; // Checked-out visitors are completed visits

        // Pie Chart for Visit Status
        var ctx1 = document.getElementById('statusChart').getContext('2d');
        var statusChart = new Chart(ctx1, {
            type: 'pie',
            data: {
                labels: ['Confirmed', 'Pending', 'Declined', 'Blacklisted'],
                datasets: [{
                    data: [40, 30, 20, 10], // Sample data for the new categories
                    backgroundColor: [
                        'rgba(40, 167, 69, 0.8)', // Confirmed - green
                        'rgba(255, 193, 7, 0.8)', // Pending - yellow
                        'rgba(220, 53, 69, 0.8)', // Declined - red
                        'rgba(108, 117, 125, 0.8)' // Blacklisted - gray
                    ],
                    borderColor: [
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' (' + Math.round((tooltipItem.raw / 100) * 100) + '%)';
                            }
                        }
                    }
                }
            }
        });

        // Bar Chart for Today's Visitors
        var ctx2 = document.getElementById('visitorsChart').getContext('2d');
        var visitorsChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Checked In', 'Checked Out'],
                datasets: [{
                    label: 'Visitors',
                    data: [checkedIn, checkedOut], // Use the variables for checked in and checked out
                    backgroundColor: [
                        'rgba(40, 167, 69, 0.8)', // Checked In - green
                        'rgba(220, 53, 69, 0.8)' // Checked Out - red
                    ],
                    borderColor: [
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Visitors'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.dataset.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });

        // Sidebar Toggle Functionality
        const toggles = document.querySelectorAll('.toggle-visitors, .toggle-visitlogs, .toggle-reports');

        toggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const submenu = this.nextElementSibling;
                submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
                this.querySelector('.arrow').style.transform = submenu.style.display === 'block' ? 'rotate(90deg)' : 'rotate(0deg)';
            });
        });
    </script>
</body>
</html>
