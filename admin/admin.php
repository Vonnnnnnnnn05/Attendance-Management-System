<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
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
  </style>
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
  <div class="content p-4">
    <div class="container">
      <h3 class="mb-3">Welcome Admin!</h3>
      <p class="text-muted">Manage students, attendance, records, and reports from this dashboard.</p>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function confirmLogout() {
      if (confirm("Are you sure you want to logout?")) {
        window.location.href = "../index.php";
      }
    }
  </script>
</body>

</html>
