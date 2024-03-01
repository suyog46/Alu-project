<?php 
function totalcat($cat)
{
      include 'connect.php';
      $sql = "SELECT * FROM courses WHERE category = '$cat' ";
      $result = mysqli_query($con, $sql);
      return mysqli_num_rows($result);
}

?>
