<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Attendance System - Login</title>
  <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" type="image/png">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

  <style>
    body {
      background: linear-gradient(to right, #6fb1fc, #4364f7);
      min-height: 100vh;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Segoe UI', sans-serif;
    }

    .login-container {
      background-color: #fff;
      padding: 50px 35px;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
      text-align: center;
      width: 100%;
      max-width: 420px;
      animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }

    .login-container img {
      width: 90px;
      margin-bottom: 20px;
    }

    .login-container h2 {
      font-weight: bold;
      color: #343a40;
      margin-bottom: 30px;
    }

    .role-btn {
      padding: 12px 0;
      font-size: 1.15rem;
      font-weight: 600;
      transition: all 0.2s ease-in-out;
      border: none;
      border-radius: 8px;
    }

    .role-btn i {
      margin-right: 10px;
    }

    .admin-btn {
      background-color: #0d6efd;
      color: #fff;
    }

    .admin-btn:hover {
      background-color: #084298;
      transform: translateY(-2px);
    }

    .student-btn {
      background-color: #198754;
      color: #fff;
    }

    .student-btn:hover {
      background-color: #146c43;
      transform: translateY(-2px);
    }

    footer {
      position: absolute;
      bottom: 10px;
      width: 100%;
      text-align: center;
      font-size: 0.85rem;
      color: #f0f0f0;
    }

    @media (max-width: 576px) {
      .login-container {
        padding: 35px 25px;
      }
    }
  </style>
</head>
<body>
  <!--Start of Tawk.to Script-->
  <script type="text/javascript">
    var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
    (function(){
      var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
      s1.async = true;
      s1.src = 'https://embed.tawk.to/6812f726cba56419020c0d3e/1iq51asbv';
      s1.charset = 'UTF-8';
      s1.setAttribute('crossorigin', '*');
      s0.parentNode.insertBefore(s1, s0);
    })(); 
  </script>
  <!--End of Tawk.to Script-->

  <div class="login-container">
    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="NSTP Logo">
    <h2>Welcome to Attendance Portal</h2>
    <div class="d-grid gap-3">
      <button onclick="redirectTo('admin/login.php')" class="btn role-btn admin-btn">
        <i class="fas fa-user-shield"></i> Admin
      </button>
      <button onclick="redirectTo('student/student.php')" class="btn role-btn student-btn">
        <i class="fas fa-user-graduate"></i> Student
      </button>
    </div>
  </div>

  <footer>&copy; 2025 NSTP Portal. All rights reserved.</footer>

  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function redirectTo(page) {
      window.location.href = page;
    }
  </script>
</body>
</html>
