<?php
include("../conn.php");
$id = isset($_POST['studentid']) ? $_POST['studentid'] : $_GET['id'];

mysqli_query($conn, "DELETE FROM studentaccount WHERE studentid = '$id'");
?>
<script>
    window.alert("Successfully Deleted");
    window.location.href = "studentaccount.php";
</script>