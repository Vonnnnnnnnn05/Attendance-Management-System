<?php
session_start();
require __DIR__ . '/../vendor/autoload.php';
include '../conn.php';

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Writer\PngWriter;

if (!isset($_SESSION['email'])) {
    header("Location: index.html");
    exit();
}

$email = $_SESSION['email'];

$query = $conn->prepare("SELECT studentid, name, course FROM studentaccount WHERE email = ?");
$query->bind_param("s", $email);
$query->execute();
$result = $query->get_result();

if ($result->num_rows === 0) {
    echo "<script>alert('Student not found!'); window.location.href='profile_setup.php';</script>";
    exit();
}

$student = $result->fetch_assoc();
$studentid = $student['studentid'];
$name = $student['name'];
$course = $student['course'];

$qrCode = Builder::create()
    ->data($studentid)
    ->encoding(new Encoding('UTF-8'))
    ->size(150)
    ->margin(10)
    ->writer(new PngWriter())
    ->build();

$qrCodeDataUri = $qrCode->getDataUri();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Student Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <style>
    body {
      background-color: #f8f9fa;
    }
    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      width: 250px;
      background-color: #0d6efd;
      padding: 30px 20px;
      color: white;
    }
    .sidebar h2 {
      margin-bottom: 30px;
    }
    .sidebar ul {
      list-style: none;
      padding: 0;
    }
    .sidebar ul li {
      margin: 20px 0;
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
      padding: 40px;
    }
    .qr-container img {
      margin-top: 15px;
      border: 1px solid #ccc;
      padding: 5px;
      background: white;
    }
  </style>
</head>
<body>

  <div class="sidebar">
    <h2>Dashboard</h2>
    <ul>
      <li><a href="#"><i class="fas fa-home me-2"></i>Home</a></li>
      <li><a href="attendance.php"><i class="fas fa-calendar-check me-2"></i>Attendance</a></li>
      <li><a href="logout.php" onclick="return confirm('Are you sure you want to logout?')"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
    </ul>
  </div>

  <div class="content">
    <div class="container">
      <h1 class="mb-4">Welcome, <?= htmlspecialchars($name); ?>!</h1>
      <div class="row">
        <div class="col-md-6 mb-4">
          <div class="card shadow">
            <div class="card-body">
              <h5 class="card-title">Student Info</h5>
              <p><strong>ID:</strong> <?= htmlspecialchars($studentid); ?></p>
              <p><strong>Name:</strong> <?= htmlspecialchars($name); ?></p>
              <p><strong>Course:</strong> <?= htmlspecialchars($course); ?></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-4">
          <div class="card shadow text-center">
            <div class="card-body">
              <h5 class="card-title">Your QR Code</h5>
              <div id="qr-info">
                <p><strong>Name:</strong> <?= htmlspecialchars($name); ?></p>
                <p><strong>Course:</strong> <?= htmlspecialchars($course); ?></p>
              </div>
              <img src="<?= $qrCodeDataUri; ?>" alt="Student QR Code" class="img-fluid" />
              <a href="generate_id.php" target="_blank" class="btn btn-primary mt-3">
                <i class="fas fa-id-card"></i> Generate Student ID
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
