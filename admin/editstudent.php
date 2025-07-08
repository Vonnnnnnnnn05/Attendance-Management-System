<?php
include("../conn.php");

$id = $_GET['id']; 
$query = mysqli_query($conn, "SELECT * FROM studentaccount WHERE studentid = '$id'");
$student = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="edit.css">
</head>
<body>
<h2>Edit Student</h2>
    
    <form action="edit.php?id=<?php echo $id; ?>" method="post">
        <label>Student ID:</label>
       
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $student['name']; ?>" required><br>

        <label>Course:</label>
        <input type="text" name="course" value="<?php echo $student['course']; ?>" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $student['email']; ?>" required><br>

        <label>Password:</label>
        <input type="text" name="studentpassword" value="<?php echo $student['studentpassword']; ?>" required><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
