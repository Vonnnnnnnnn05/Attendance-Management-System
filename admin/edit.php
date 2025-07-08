    <?php

    include("../conn.php");

    $id= $_GET['id'];

   
    $name = $_POST['name'];
    $course = $_POST['course'];
    $email = $_POST['email'];
    $studentpassword = $_POST['studentpassword'];




    mysqli_query($conn, "UPDATE studentaccount set  name = '$name', course = '$course', email = '$email', studentpassword = '$studentpassword' WHERE studentid = '$id'");


    ?>

    <script>
        window.alert("Edit Successful");
        window.location = "studentaccount.php";
    </script>