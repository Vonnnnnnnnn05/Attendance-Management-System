<?php
include '../conn.php';

$email = $_POST['email'];
$studentpassword = $_POST['studentpassword'];
$confirmpassword = $_POST['confirmpassword'];

// Check if password and confirm password match
if ($studentpassword != $confirmpassword) {
    echo "<script>
            alert('Passwords do not match. Please try again.');
            window.location = 'register.php';
          </script>";
    exit();
}

// If passwords match, insert into the database
mysqli_query($conn, "INSERT INTO studentaccount(email, studentpassword) VALUES('$email', '$studentpassword')");

?>
<script>
    window.alert("Successfully Registered");
    window.location = "student.php";
</script>
