<?php
include("../conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $attendanceid = $_POST['attendanceid'];
    $status = $_POST['status'];
    $date_recorded = $_POST['date_recorded'];

    $stmt = $conn->prepare("UPDATE attendance SET status=?, date_recorded=? WHERE attendanceid=?");
    $stmt->bind_param("ssi", $status, $date_recorded, $attendanceid);
    if ($stmt->execute()) {
        echo "<script>alert('Attendance record updated successfully!'); window.location.href='records.php';</script>";
    } else {
        echo "<script>alert('Failed to update record.'); window.location.href='records.php';</script>";
    }
    $stmt->close();
    $conn->close();
} else {
    header("Location: records.php");
    exit();
}
?>
