<?php
session_start();
include '../conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['username'];
    $password = $_POST['studentpassword'];

    // Get student details from the database
    $result = mysqli_query($conn, "SELECT * FROM studentaccount WHERE email = '$email'");
    
    if ($display = mysqli_fetch_assoc($result)) {
        if ($password === $display['studentpassword']) { // Match password directly (Consider hashing for security)
            $_SESSION['studentid'] = $display['studentid'];
            $_SESSION['name'] = $display['name'];
            $_SESSION['email'] = $display['email'];

            // Check if profile is complete
            if (empty($display['studentid']) || empty($display['name']) || empty($display['course'])) {
                echo "<script>
                    alert('Please complete your profile.');
                    window.location.href = 'profile_setup.php';
                </script>";
                exit();
            } else {
                echo "<script>
                    alert('Login successful!');
                    window.location.href = 'dashboard.php';
                </script>";
                exit();
            }
        }
    }
    
    // If login fails
    echo "<script>
        alert('Invalid email or password.');
        window.location.href = 'student.php';
    </script>";
}
?>
