<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NSTP Attendance Report</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    
    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .sidebar-link {
            display: block;
            padding: 10px 15px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.2s;
        }

        .sidebar-link:hover {
            background-color: #0d6efd;
            color: white;
        }

        .menu-toggle {
            cursor: pointer;
            z-index: 1050;
        }

        .content {
            margin-left: 270px;
            padding: 20px;
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }

            #menu-toggle:checked ~ .sidebar {
                display: block;
            }

            .content {
                margin-left: 0;
                padding-top: 70px;
            }
        }

        .table-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f8f9fa;
        }

        .print-btn {
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin: 20px 0;
        }

        .print-btn:hover {
            background-color: #004085;
        }
    </style>

    <script>
        window.onload = function() {
            window.print(); // Auto-opens print dialog on page load
        };
    </script>
</head>
<body>
    <!-- Hidden Checkbox to Toggle Sidebar -->
    <input type="checkbox" id="menu-toggle" class="d-none" />

    <!-- Sidebar -->
    <div class="sidebar bg-primary text-white p-3 shadow-lg">
        <h2 class="text-center mb-4">Admin Panel</h2>
        <ul class="list-unstyled">
            <li><a href="studentaccount.php" class="sidebar-link"><i class="fas fa-user-graduate me-2"></i>Student Accounts</a></li>
            <li><a href="manage_attendance.php" class="sidebar-link"><i class="fas fa-calendar-check me-2"></i>Manage Attendance</a></li>
            <li><a href="records.php" class="sidebar-link"><i class="fas fa-folder me-2"></i>Records</a></li>
            <li><a href="reports.php" class="sidebar-link"><i class="fas fa-chart-bar me-2"></i>Reports</a></li>
            <li><a href="#" onclick="confirmLogout()" class="sidebar-link"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
        </ul>
    </div>

    <!-- Toggle Button -->
    <label for="menu-toggle" class="menu-toggle position-fixed top-0 start-0 m-3 bg-primary text-white p-3 rounded-circle shadow d-md-none">
        <i class="fas fa-bars"></i>
    </label>

    <!-- Main Content -->
    <div class="content">
        <div class="container">
            <h3 class="mb-3">NSTP Attendance Report</h3>

            <!-- Print Button -->
            <button class="print-btn" onclick="window.print()">Print Report</button>

            <!-- Report Table -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("../conn.php");

                        $data = mysqli_query($conn, "SELECT sa.name, sa.course, a.date_recorded, a.status 
                                                     FROM studentaccount sa 
                                                     RIGHT JOIN attendance a ON sa.studentid = a.studentid");

                        while ($display = mysqli_fetch_array($data)) {
                            echo "<tr>";
                            echo "<td>" . $display['name'] . "</td>";
                            echo "<td>" . $display['course'] . "</td>";
                            echo "<td>" . date('F d, Y', strtotime($display['date_recorded'])) . "</td>";
                            echo "<td>" . $display['status'] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function confirmLogout() {
            if (confirm("Are you sure you want to logout?")) {
                window.location.href = "../index.php";
            }
        }
    </script>
</body>
</html>
