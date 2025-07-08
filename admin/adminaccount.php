<?php
// Start the session to track logged-in users
session_start();


include '../conn.php'; // Ensure conn.php is correctly placed

// Check if form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Secure user input to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password']; // Plain text password (not secure)

    // Directly execute the query without storing it in a variable
    $result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");

    // Check if query executed successfully
    if (!$result) {
        die("Query Failed: " . mysqli_error($conn)); // Display error if query fails
    }

    // Fetch the result as an associative array
    $admin = mysqli_fetch_assoc($result);

    // Check if user exists and password matches
    if ($admin && $password === $admin['adminpassword']) { 
        // Store admin session
        $_SESSION['admin'] = $admin['username']; 

        // Redirect to admin.php (admin dashboard) with a success message
        echo "<script>
                alert('Login successful!');
                window.location='studentaccount.php'; 
              </script>";
        exit();
    } else {
        // Redirect back to login.php with an error message if authentication fails
        echo "<script>
                alert('Invalid username or password');
                window.location='login.php';
              </script>";
    }
}
?>
