
<?php 
include 'connect.php';
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql1 = "DELETE FROM courses WHERE course_id = '$id'";
    $result1 = mysqli_query($con, $sql1);
    $sql2 = "DELETE FROM student_courses WHERE course_id = '$id'";
    $result2 = mysqli_query($con, $sql2);
    if ($result2) {
        echo 'deleted sucessfully';
        session_start();
        if($_SESSION["usertype"]=="teacher"){
     header('location: ../Courses/outercourse.php?id='.$_SESSION["loginid"].' ');
        }
    } 
    else {
        echo 'not deleted sucessfully';
    }
}
?>
