<?php
include('../conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['studentid'], $_POST['status'], $_POST['date_recorded'])) {
    $studentid = $_POST['studentid'];
    $status = $_POST['status'];
    $date_recorded = $_POST['date_recorded'];

    if (mysqli_query($conn, "INSERT INTO attendance (studentid, status, date_recorded) VALUES ('$studentid', '$status', '$date_recorded')")) {
        $result = mysqli_query($conn, "SELECT sa.name, sa.course, a.date_recorded 
                                       FROM studentaccount sa 
                                       LEFT JOIN attendance a ON sa.studentid = a.studentid 
                                       WHERE sa.studentid = '$studentid' 
                                       ORDER BY a.date_recorded DESC LIMIT 1");

        if ($display = mysqli_fetch_assoc($result)) {
            echo "Attendance recorded successfully!\n";
            echo "Name: " . $display['name'] . "\n";
            echo "Course: " . $display['course'] . "\n";
            echo "Date Recorded: " . $display['date_recorded'] . "\n";
        } else {
            echo "Error: Student details not found.";
        }
    } else {
        echo "Error inserting attendance.";
    }
} else {
    echo "Error: Required data missing.";
}
?>
