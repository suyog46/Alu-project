
<?php 
include 'connect.php';
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql1 = "DELETE FROM users WHERE user_id = '$id'";
    $result1 = mysqli_query($con, $sql1);
    $sql2 = "DELETE FROM courses WHERE uid = '$id'";
    $result2 = mysqli_query($con, $sql2);
    if ($result2) {
        echo 'deleted sucessfully';
  
            header('location: ../Users/teachers.php');
               
    } 
    else {
        echo 'not deleted sucessfully';
    }
}
?>
