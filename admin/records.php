<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Reports</title>

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

    .reports-container {
      background-color: white;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    table th,
    table td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    table th {
      background-color: #0d6efd;
      color: white;
    }

    .btn-primary {
      background-color: #0d6efd;
      border: none;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
    }

    .btn-primary:hover {
      background-color: #004085;
    }

    .sidebar h2 {
      line-height: 1.2;
      font-size: 2rem;
      font-weight: 900;
      letter-spacing: 1px;
      text-shadow: 0 4px 24px rgba(0, 0, 0, 0.18);
    }
  </style>
</head>

<body>
  <!-- Hidden Checkbox to Toggle Sidebar -->
  <input type="checkbox" id="menu-toggle" class="d-none" />

  <!-- Sidebar -->
  <div class="sidebar bg-primary text-white p-3 shadow-lg">
    <h2 class="text-center mb-4">
      Admin<br>Panel
    </h2>
    <ul class="list-unstyled">
      <li><a href="studentaccount.php" class="sidebar-link"><i class="fas fa-user-graduate me-2"></i>Student Accounts</a>
      </li>
      <li><a href="manage_attendance.php" class="sidebar-link"><i class="fas fa-calendar-check me-2"></i>Manage Attendance
          </a></li>
      <li><a href="records.php" class="sidebar-link"><i class="fas fa-folder me-2"></i>Records</a></li>
      <li><a href="reports.php" class="sidebar-link"><i class="fas fa-chart-bar me-2"></i>Reports</a></li>
      <li><a href="#" onclick="confirmLogout()" class="sidebar-link"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
      </li>
    </ul>
  </div>

  <!-- Toggle Button -->
  <label for="menu-toggle"
    class="menu-toggle position-fixed top-0 start-0 m-3 bg-primary text-white p-3 rounded-circle shadow d-md-none">
    <i class="fas fa-bars"></i>
  </label>

  <!-- Main Content -->
  <div class="content p-4">
    <div class="container">
      <h3 class="mb-3">Reports</h3>
      <div class="reports-container">
        <h5>Attendance Report</h5>
        <!-- Add your report content here -->
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Status</th>
              <th>Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include("../conn.php");

            $data = mysqli_query($conn, "SELECT a.attendanceid, sa.studentid, sa.name, a.status, a.date_recorded 
                FROM studentaccount sa 
                RIGHT JOIN attendance a ON sa.studentid = a.studentid 
                ORDER BY a.date_recorded");

            while ($display = mysqli_fetch_assoc($data)) {
            ?>
            <tr>
              <td><?php echo $display['studentid']; ?></td>
              <td><?php echo $display['name']; ?></td>
              <td><?php echo $display['status']; ?></td>
              <td><?php echo date("F d, Y", strtotime($display['date_recorded'])); ?></td>
              <td>
                <!-- Edit Button triggers modal -->
                <button class="btn btn-sm btn-warning"
                  data-bs-toggle="modal"
                  data-bs-target="#editModal<?php echo $display['attendanceid']; ?>">
                  <i class="fas fa-edit"></i> Edit
                </button>
                <a href="deleteattendance.php?id=<?php echo $display['attendanceid']; ?>" class="btn btn-sm btn-danger"
                  onclick="return confirm('Are you sure you want to delete this record?')"><i class="fas fa-trash"></i>
                  Delete</a>
              </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal<?php echo $display['attendanceid']; ?>" tabindex="-1"
              aria-labelledby="editModalLabel<?php echo $display['attendanceid']; ?>" aria-hidden="true">
              <div class="modal-dialog">
                <form method="post" action="edtr.php">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="editModalLabel<?php echo $display['attendanceid']; ?>">Edit Attendance
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" name="attendanceid" value="<?php echo $display['attendanceid']; ?>">
                      <div class="mb-3">
                        <label class="form-label">Student ID</label>
                        <input type="text" class="form-control" value="<?php echo $display['studentid']; ?>" readonly>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" value="<?php echo $display['name']; ?>" readonly>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                          <option value="Present" <?php if($display['status']=="Present") echo "selected"; ?>>Present
                          </option>
                          <option value="Absent" <?php if($display['status']=="Absent") echo "selected"; ?>>Absent
                          </option>
                          <option value="Late" <?php if($display['status']=="Late") echo "selected"; ?>>Late
                          </option>
                          <option value="Excused" <?php if($display['status']=="Excused") echo "selected"; ?>>Excused
                          </option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" name="date_recorded" class="form-control"
                          value="<?php echo date('Y-m-d', strtotime
            <?php
            }
            ?>
          </tbody>
        </table>

        <!-- Download Report Button -->
        <div class="text-end mt-4">
          <form method="post" action="download_report.php">
            <button type="submit" class="btn-primary">Download Report</button>
          </form>
        </div>
      </div>
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
