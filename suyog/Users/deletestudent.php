
<?php 
include 'connect.php';
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql2 = "DELETE FROM student_courses WHERE user_id = '$id'";
    $result2 = mysqli_query($con, $sql2);
    $sql1 = "DELETE FROM users WHERE user_id = '$id'";
    $result1 = mysqli_query($con, $sql1);
    if ($result1) {
        echo 'deleted sucessfully';
  
        session_start();
     header('location:tables.php?id='.$_SESSION["loginid"].' ');
        }
               
    } 
    else {
        echo 'not deleted sucessfully';
    }

?>
