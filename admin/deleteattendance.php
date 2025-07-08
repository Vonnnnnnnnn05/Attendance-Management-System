<?php
include("../conn.php");

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM attendance WHERE attendanceid = '$id'");
header("Location: records.php");
?>
