<?php
session_start();
include("../conn.php");

if (!isset($_SESSION['studentid'])) {
    header("Location: ../index.php");
    exit();
}

$studentid = $_SESSION['studentid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Student Dashboard</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- Font Awesome -->
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }

    .sidebar {
      height: 100vh;
      background-color: #0d6efd;
      padding: 30px 20px;
      color: white;
      position: fixed;
      width: 250px;
    }

    .sidebar h2 {
      margin-bottom: 40px;
      font-weight: bold;
    }

    .sidebar ul {
      list-style: none;
      padding: 0;
    }

    .sidebar ul li {
      margin: 15px 0;
    }

    .sidebar ul li a {
      color: white;
      text-decoration: none;
      font-size: 1.1rem;
    }

    .sidebar ul li a:hover {
      text-decoration: underline;
    }

    .content {
      margin-left: 270px;
      padding: 40px 30px;
    }

    .content h2 {
      margin-bottom: 30px;
      font-weight: 600;
    }

    table {
      background-color: white;
      border-radius: 10px;
      overflow: hidden;
    }

    th {
      background-color: #0d6efd;
      color: white;
    }

    td, th {
      text-align: center;
      vertical-align: middle;
    }
  </style>
</head>
<body>

  <div class="sidebar">
    <h2>Dashboard</h2>
    <ul>
      <li><a href="dashboard.php"><i class="fas fa-home me-2"></i> Home</a></li>
      <li><a href="attendance.php"><i class="fas fa-calendar-check me-2"></i> Attendance</a></li>
      <li><a href="logout.php" onclick="return confirmLogout()"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
    </ul>
  </div>

  <div class="content">
    <h2>My Attendance</h2>
    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Status</th>
            <th>Attendance Date</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include("../conn.php");
          $data = mysqli_query($conn, "SELECT a.date_recorded, a.status, s.name, s.studentid
                                       FROM attendance a 
                                       LEFT JOIN studentaccount s ON a.studentid = s.studentid
                                       WHERE a.studentid = '$studentid'");
          while ($display = mysqli_fetch_assoc($data)) {
          ?>
            <tr>
              <td><?= $display['studentid']; ?></td>
              <td><?= $display['name']; ?></td>
              <td><?= $display['status']; ?></td>
              <td><?= date("F d, Y", strtotime($display['date_recorded'])); ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    function confirmLogout() {
      return confirm("Are you sure you want to logout?");
    }
  </script>

</body>
</html>
