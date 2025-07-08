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
    echo "Student not found.";
    exit();
}

$student = $result->fetch_assoc();
$qrCode = Builder::create()
    ->data($student['studentid'])
    ->encoding(new Encoding('UTF-8'))
    ->size(120)
    ->margin(5)
    ->writer(new PngWriter())
    ->build();
$qrImage = $qrCode->getDataUri();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student ID</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f1f1f1;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .id-card {
      background: white;
      border: 2px solid #0d6efd;
      border-radius: 10px;
      padding: 25px;
      text-align: center;
      width: 340px;
    }
    .id-card h2 {
      color: #0d6efd;
      margin-bottom: 20px;
    }
    .id-card p {
      margin: 6px 0;
      font-size: 16px;
    }
    .id-card img {
      margin-top: 15px;
      border: 1px solid #ccc;
      padding: 5px;
      background: white;
    }
    .print-btn {
      margin-top: 15px;
    }
    .print-btn button {
      padding: 10px 20px;
      font-size: 16px;
      background-color: #0d6efd;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-right: 10px;
    }
    @media print {
      .print-btn { display: none; }
    }
  </style>
</head>
<body>

<div class="id-card">
  <h2>Student ID</h2>
  <p><strong>ID:</strong> <?= htmlspecialchars($student['studentid']); ?></p>
  <p><strong>Name:</strong> <?= htmlspecialchars($student['name']); ?></p>
  <p><strong>Course:</strong> <?= htmlspecialchars($student['course']); ?></p>
  <img src="<?= $qrImage; ?>" alt="QR Code">
  <div class="print-btn">
    <button onclick="window.print()">Print ID</button>
    <button onclick="window.location.href='dashboard.php'">Back</button>
  </div>
</div>

</body>
</html>
