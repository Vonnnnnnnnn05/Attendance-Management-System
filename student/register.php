<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h3 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ced4da;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        input:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(38, 143, 255, 0.3);
        }

        .password-container {
            position: relative;
        }

        .password-container input {
            padding-right: 40px;
        }

        .password-container i {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            border: none;
            color: #fff;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .go-to-login {
            display: block;
            text-align: center;
            margin-top: 10px;
        }

        .go-to-login a {
            color: #007bff;
            text-decoration: none;
        }

        .go-to-login a:hover {
            text-decoration: underline;
        }

        /* Animation */
        .container {
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

    <div class="container">
        <h3>Student Registration</h3>
        <form action="sendregistration.php" method="post">
            <input type="email" placeholder="Email Address" name="email" required>

            <div class="password-container">
                <input type="password" id="password" placeholder="Password" name="studentpassword" required>
                <i class="fa fa-eye" id="togglePassword"></i>
            </div>

            <div class="password-container">
                <input type="password" id="confirmPassword" placeholder="Confirm Password" name="confirmpassword" required>
                <i class="fa fa-eye" id="toggleConfirmPassword"></i>
            </div>

            <button type="submit">Create Account</button>

            <div class="go-to-login">
                <button type="button" onclick="window.location.href='student.php';">Go to Login</button>
            </div>
        </form>
    </div>

    <script>
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');
        togglePassword.addEventListener('click', function () {
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;
            this.classList.toggle('fa-eye-slash');
        });

        // Toggle confirm password visibility
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPasswordField = document.getElementById('confirmPassword');
        toggleConfirmPassword.addEventListener('click', function () {
            const type = confirmPasswordField.type === 'password' ? 'text' : 'password';
            confirmPasswordField.type = type;
            this.classList.toggle('fa-eye-slash');
        });
    </script>

</body>

</html>
