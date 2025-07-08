<?php

session_start();
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session



?>
<script>
    window.alert("Logged Out");
    window.location = "../index.php";
</script>
