<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Login</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Arial', sans-serif;
    }

    .login-container {
      max-width: 400px;
      margin: 100px auto;
    }

    .card {
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      background-color: #ffffff;
    }

    .card-header {
      font-size: 24px;
      font-weight: bold;
      text-align: center;
      color: #007bff;
      margin-bottom: 20px;
    }

    .form-label {
      font-size: 1rem;
      font-weight: 600;
      color: #495057;
    }

    .form-control {
      border-radius: 8px;
      border: 1px solid #ced4da;
      transition: border-color 0.3s ease;
    }

    .form-control:focus {
      border-color: #007bff;
      box-shadow: 0 0 0 0.25rem rgba(38, 143, 255, 0.25);
    }

    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
      transition: background-color 0.3s ease, border-color 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #004085;
    }

    .btn-outline-secondary {
      border-radius: 8px;
      margin-top: 10px;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-outline-secondary:hover {
      background-color: #e2e6ea;
      color: #495057;
    }

    /* Animation for the card */
    .card {
      animation: fadeIn 0.8s ease-in-out;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body>

  <div class="container login-container">
    <div class="card">
      <div class="card-header">Admin Login</div>
      <form action="adminaccount.php" method="POST" novalidate>
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" name="username" id="username" class="form-control" placeholder="Enter username" required>
          <div class="invalid-feedback">
            Please provide a valid username.
          </div>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
          <div class="invalid-feedback">
            Please provide a password.
          </div>
        </div>
        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Login</button>
          <a href="../index.php" class="btn btn-outline-secondary">← Back</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Custom JS for form validation -->
  <script>
    (function () {
      'use strict'

      var forms = document.querySelectorAll('.needs-validation')

      Array.prototype.slice.call(forms)
        .forEach(function (form) {
          form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }
            form.classList.add('was-validated')
          }, false)
        })
    })()
  </script>
</body>
</html>
