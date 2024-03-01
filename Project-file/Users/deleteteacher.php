
<?php 
include 'connect.php';
session_start();
if (isset($_GET["id"])) {
    $id = $_GET["id"];

                $sql="SELECT course_id FROM courses
                    WHERE uid='$id'
                ";
                $result=mysqli_query($con,$sql);
                if(mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){
                       $cid=$row['course_id'] ;
                       $sql3 = "DELETE FROM student_courses WHERE course_id= '$cid'";
                        $result3 = mysqli_query($con, $sql3);
                    }
                }
    $sql2 = "DELETE FROM courses WHERE uid = '$id'";

    $result2 = mysqli_query($con, $sql2);
    $sql1 = "DELETE FROM users WHERE user_id = '$id'";
    $result1 = mysqli_query($con, $sql1);
    if($result1){
    
        // echo $_SESSION['loginid'];
        header('location:teachers.php?id='.$_SESSION["loginid"].' ');
               
    } 
    else {
        echo 'not deleted sucessfully';
    }
}

?>
