<?php
session_start();
include '../conn.php';

if (!isset($_SESSION['email'])) {
    header("Location: dashboard.php");
    exit();
}

$email = $_SESSION['email'];

// Check if the profile is already set up
$query = "SELECT studentid, name, course FROM studentaccount WHERE email = '$email'";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "<script>alert('Student not found!'); window.location.href='dashboard.php';</script>";
    exit();
}

$student = mysqli_fetch_assoc($result);
$studentid = $student['studentid'];
$name = $student['name'];
$course = $student['course'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentid = $_POST['studentid'];
    $name = $_POST['name'];
    $course = $_POST['course'];

    // Update the student's profile
    $updateQuery = "UPDATE studentaccount SET studentid = '$studentid', name = '$name', course = '$course' WHERE email = '$email'";
    
    if (mysqli_query($conn, $updateQuery)) {
        header("Location: dashboard.php"); // Redirect to dashboard
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Your Profile</title>
    <link rel="stylesheet" href="profile_setup.css">
</head>
<body>
    <h2>Complete Your Profile</h2>
    <form method="post">
        <input type="text" name="studentid" placeholder="Enter your Student ID" required>
        <input type="text" name="name" placeholder="Enter your name" required>
        <input type="text" name="course" placeholder="Enter your course" required>
        <button type="submit">Save</button>
    </form>
</body>
</html>
