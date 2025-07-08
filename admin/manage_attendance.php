<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Manage Attendance</title>

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

    .scanner-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      background-color: white;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    #scanner-container video {
      max-width: 100%;
      border-radius: 8px;
    }

    .input-section {
      margin-top: 20px;
    }

    .input-section input {
      margin-right: 10px;
      padding: 8px;
      width: 200px;
    }

    .input-section button {
      padding: 8px 15px;
      background-color: #0d6efd;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .input-section button:hover {
      background-color: #004085;
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
      <h3 class="mb-3">Manage Attendance</h3>
      <div class="scanner-container">
        <h5>QR Code Scanner</h5>
        <video id="video" autoplay playsinline></video>
        <canvas id="canvas" class="d-none"></canvas>
        <div id="result">Scan a QR code to see the result.</div>

        <!-- Input and Record Button -->
        <div class="input-section">
          <input type="number" id="studentId" placeholder="Enter ID Number">
          <input type="date" id="attendanceDate">
          <button onclick="sendAttendance()">Record</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jsqr/dist/jsQR.min.js"></script>
  <script>
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const resultDiv = document.getElementById('result');
    let scanning = true;

    async function startScanner() {
      try {
        const stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } });
        video.srcObject = stream;
        video.play();
        requestAnimationFrame(scanQRCode);
      } catch (error) {
        resultDiv.textContent = "Error accessing camera: " + error.message;
      }
    }

    function scanQRCode() {
      if (!scanning) return;

      if (video.readyState === video.HAVE_ENOUGH_DATA) {
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;

        const context = canvas.getContext('2d');
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
        const code = jsQR(imageData.data, imageData.width, imageData.height, { inversionAttempts: "dontInvert" });

        if (code) {
          scanning = false;
          resultDiv.textContent = "QR Code Detected: " + code.data;
          document.getElementById('studentId').value = code.data;
          document.getElementById('attendanceDate').value = new Date().toISOString().split('T')[0];

          sendAttendance(code.data);
          return;
        } else {
          resultDiv.textContent = "Scanning...";
        }
      }

      requestAnimationFrame(scanQRCode);
    }

    function sendAttendance(scannedId = null) {
      const studentId = scannedId || document.getElementById('studentId').value;
      const status = 'Present';
      const dateRecorded = document.getElementById('attendanceDate').value;

      if (!studentId || !dateRecorded) {
        alert("Please enter a valid student ID and select a date.");
        return;
      }

      const formData = new FormData();
      formData.append('studentid', studentId);
      formData.append('status', status);
      formData.append('date_recorded', dateRecorded);

      fetch('sendattendance.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.text())
      .then(data => {
        // Show notification and reload page with student name
        window.location = window.location.pathname + '?notification=' + encodeURIComponent(data);
      })
      .catch(error => {
        resultDiv.textContent = "Error sending data: " + error.message;
        scanning = true;
        requestAnimationFrame(scanQRCode);
      });
    }

    startScanner();

    // At the top of your <script> tag or after DOMContentLoaded
    if (window.location.search.includes('notification=')) {
      const params = new URLSearchParams(window.location.search);
      const notification = params.get('notification');
      if (notification) {
        alert(notification);
        // Remove notification from URL after showing
        window.history.replaceState({}, document.title, window.location.pathname);
      }
    }

    function confirmLogout() {
      if (confirm("Are you sure you want to logout?")) {
        window.location.href = "../index.php";
      }
    }
  </script>
</body>

</html>
