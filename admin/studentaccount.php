<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard</title>

  <!-- Bootstrap and Icons -->
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
      background-color: #0d6efd;
      color: white;
      padding: 20px;
      z-index: 1000;
    }

    .sidebar h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .sidebar ul {
      list-style: none;
      padding: 0;
    }

    .sidebar ul li {
      margin-bottom: 15px;
    }

    .sidebar ul li a {
      color: white;
      text-decoration: none;
      display: block;
      padding: 8px 12px;
      border-radius: 5px;
      transition: background 0.3s;
    }

    .sidebar ul li a:hover {
      background-color: #0a58ca;
    }

    .menu-toggle {
      position: fixed;
      top: 20px;
      left: 20px;
      z-index: 1100;
      background-color: #0d6efd;
      color: white;
      padding: 10px 12px;
      border-radius: 50%;
      cursor: pointer;
      display: none;
    }

    .content {
      margin-left: 270px;
      padding: 30px;
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
        padding-top: 80px;
      }

      .menu-toggle {
        display: block;
      }
    }
  </style>
</head>

<body>
  <!-- Hidden Checkbox for Toggle -->
  <input type="checkbox" id="menu-toggle" class="d-none" />

  <!-- Sidebar -->
  <div class="sidebar">
    <h2>Admin Panel</h2>
    <ul>
      <li><a href="studentaccount.php"><i class="fas fa-user-graduate me-2"></i> Student Accounts</a></li>
      <li><a href="manage_attendance.php"><i class="fas fa-calendar-check me-2"></i> Manage Attendance</a></li>
      <li><a href="#"><i class="fas fa-folder me-2"></i> Records</a></li>
      <li><a href="#"><i class="fas fa-chart-bar me-2"></i> Reports</a></li>
      <li><a href="#" onclick="confirmLogout()"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
    </ul>
    <script>
      function confirmLogout() {
        if (confirm("Are you sure you want to logout?")) {
          window.location.href = "../index.php";
        }
      }
    </script>
  </div>

  <!-- Toggle Button -->
  <label for="menu-toggle" class="menu-toggle">
    <i class="fas fa-bars"></i>
  </label>

  <!-- Main Content -->
  <div class="content">
    <div class="container">
      <h3 class="mb-3">Welcome Admin!</h3>
      <p class="text-muted">Manage students, attendance, records, and reports from this dashboard.</p>

      <!-- Student Table -->
      <div class="card mt-4">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0">Student Accounts</h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
              <thead class="table-primary">
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Course</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include('../conn.php');
                $data = mysqli_query($conn, "SELECT * FROM studentaccount");
                while ($display = mysqli_fetch_assoc($data)) {
                ?>
                  <tr>
                    <td><?php echo $display['studentid']; ?></td>
                    <td><?php echo $display['name']; ?></td>
                    <td><?php echo $display['email']; ?></td>
                    <td><?php echo $display['course']; ?></td>
                    <td>
                      <button class="btn btn-sm btn-success me-1" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $display['studentid']; ?>">
                        <i class="fa fa-edit"></i> Edit
                      </button>
                      <a href="deletestudent.php?id=<?php echo $display['studentid']; ?>"
                        class="btn btn-sm btn-danger"
                        onclick="return confirm('Are you sure you want to delete this student?');">
                        <i class="fa fa-trash"></i> Delete
                      </a>
                    </td>
                  </tr>
                  <!-- Edit Modal -->
                  <div class="modal fade" id="editModal<?php echo $display['studentid']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?php echo $display['studentid']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                      <form method="post" action="edit.php?id=<?php echo $display['studentid']; ?>">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel<?php echo $display['studentid']; ?>">Edit Student</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div class="mb-3">
                              <label class="form-label">Student ID</label>
                              <input type="text" class="form-control" value="<?php echo $display['studentid']; ?>" readonly>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Name</label>
                              <input type="text" name="name" class="form-control" value="<?php echo $display['name']; ?>" required>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Course</label>
                              <input type="text" name="course" class="form-control" value="<?php echo $display['course']; ?>" required>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Email</label>
                              <input type="email" name="email" class="form-control" value="<?php echo $display['email']; ?>" required>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Password</label>
                              <input type="text" name="studentpassword" class="form-control" value="<?php echo $display['studentpassword']; ?>" required>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Pie Chart Section for Course Distribution -->
      <div class="card mt-4">
        <div class="card-header bg-success text-white">
          <h5 class="mb-0">Student Distribution by College</h5>
        </div>
        <div class="card-body">
          <canvas id="coursePieChart" style="max-width: 400px; margin: 0 auto;"></canvas>
        </div>
      </div>

    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    <?php
      include('../conn.php');
      $ccs = 0; $engineering = 0; $cit = 0;
      $data = mysqli_query($conn, "SELECT course FROM studentaccount");
      while ($row = mysqli_fetch_assoc($data)) {
        $course = strtoupper(str_replace(' ', '', $row['course']));
        $prefix = substr($course, 0, 5);
        $prefix4 = substr($course, 0, 4);
        if (in_array($prefix, ['BSIT', 'BSIS', 'BSCS']) || in_array($prefix4, ['BSIT', 'BSIS', 'BSCS'])) {
          $ccs++;
        } else if (in_array($prefix, ['BSCE', 'BSECE', 'BSCPE']) || in_array($prefix4, ['BSCE', 'BSECE', 'BSCPE'])) {
          $engineering++;
        } else {
          $cit++;
        }
      }
    ?>
    const coursePieData = {
      labels: ['College of Computer Studies', 'College of Engineering', 'College Of Industrial Technology'],
      datasets: [{
        data: [<?php echo $ccs; ?>, <?php echo $engineering; ?>, <?php echo $cit; ?>],
        backgroundColor: ['#198754', '#dc3545', '#0d6efd'], // green, red, blue
      }]
    };
    window.addEventListener('DOMContentLoaded', function() {
      const ctx = document.getElementById('coursePieChart').getContext('2d');
      new Chart(ctx, {
        type: 'pie',
        data: coursePieData,
        options: {
          responsive: true,
          plugins: { legend: { position: 'bottom' } }
        }
      });
    });
  </script>
</body>

</html>
