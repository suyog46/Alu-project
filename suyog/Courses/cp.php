<?php
include 'connect.php';
// if (isset($_POST['submit'])) {
//   $user_name = $_POST['username'];
//   $email = $_POST['email'];
//   $password = $_POST['password'];
//   $cpassword = $_POST['cpassword'];
  
//   $id=$_POST['uid'];
//   if (isset($_FILES["pimage"]) && $_FILES["pimage"]["error"] == 0) {
//       $image = $_FILES["pimage"]["tmp_name"];
//       $imageBinary = base64_encode(file_get_contents($image));
//   }
//   if ($password === $cpassword) {
//       $sql = "UPDATE users
//       SET
//        username='$user_name',
//         email='$email',
//        password='$password',
//        userimage='$imageBinary'
//         WHERE user_id='$id';
//         ";
//       $result = mysqli_query($con, $sql);
//       if ($result) {
//           echo '
//           <script>
      
//       alert("successfull Update") ;   
//               </script> 
//               ';
//               if(($_SESSION['usertype'])=="teacher"||($_SESSION['usertype'])=="student"){
//                 header("Location:../Components/Logout.php");
                
//               }
//               else{
//               header('Location: ../Users/index.php?id='.$uid);                
//                 }
//       } else {
//           echo 'Update  problem';
//       }

//   } else {
//       echo "Error in running the query. " . mysqli_error($con);
//   }
// }
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="../Components/css/style.css">
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>

  <?php
  include '../Components/Navbar.php';
  ?>
  <section class="head position-relative">
    <div class="container-fluid">
      <div class="row ">
        <div class="col-lg-8  ">
          <div class="head-left mx-3 mt-5 pt-5">
            <h2>
              Join the Millions Learning to
            </h2>
            <h6>Want to excel at finance or managing people? Our online business and management courses will
              help.Further
              your career with communication, networking</h6>
          </div>
        </div>
      </div>
    </div>
  </section>
  <br><br>
  <?php
 if (isset($_GET['id'])){
    $id=$_GET['id'];
        $sql = "SELECT * FROM users where user_id='$id'";
        $result = mysqli_query($con, $sql);
        if ($result) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo '   
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">Change Profile</div>
          <div class="card-body">
           
          <form action=" '.$_SERVER["PHP_SELF"] .'" method="POST" enctype="multipart/form-data" >

            <img src="data:image/jpeg;base64,' . $row["userimage"] . '"class="rounded-circle object-fit-cover" height="80" width="80">
            <br>

            <label for="pimage">Change a profile picture</label><br>
            <input type="file" name="pimage" id="pimage" class="rounded" value="' . $row["userimage"] . '"><br><br>
            <div class="mb-3">
                <label for="username" class="form-label">Change Name</label>
                <input type="text" name="username" placeholder="'.$row["username"].'" value="'.$row["username"].'" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" placeholder=" '.$row["email"].'" value="'.$row["email"].'"class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" placeholder="'.$row["password"].'" value="'.$row["password"].'" class="form-control" required>
              </div>
              <div class="mb-3">
              <label for="password" class="form-label"> Confirm Password</label>
              <input type="password" name="cpassword" placeholder="Confirm password" class="form-control" required>
            </div>
            <input type="hidden" name="uid" value="'.$id.'">

              <div class="mb-3">
                <input type="submit" name="csubmit" class="btn btn-primary">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  ';
          }}
        }
        if (isset($_POST['csubmit'])) {
          $user_name = $_POST['username'];
          $email = $_POST['email'];
          $password = $_POST['password'];
          $cpassword = $_POST['cpassword'];
          
          $id=$_POST['uid'];
          if (isset($_FILES["pimage"]) && $_FILES["pimage"]["error"] == 0) {
              $image = $_FILES["pimage"]["tmp_name"];
              $imageBinary = base64_encode(file_get_contents($image));
          }
          if ($password === $cpassword) {
              $sql = "UPDATE users
              SET
               username='$user_name',
                email='$email',
               password='$password',
               userimage='$imageBinary'
                WHERE user_id='$id';
                ";
              $result = mysqli_query($con, $sql);
              if ($result) {
                  echo '
                  <script>
              
              alert("successfull Update") ;   
                      </script> 
                      ';
                      if(($_SESSION['usertype'])=="teacher"||($_SESSION['usertype'])=="student"){
                        echo"
                        <script> window.location.href='../Components/Logout.php';</script>
                        ";
                      }
                      else{

                        echo"
                        helluuu
                        <script> window.location.href='../Users/index.php?id=".$_SESSION['loginid'] ."';</script>
                        ";              
                        }
              } else {
                  echo 'Update  problem';
              }
        
          } else {
              echo "Error in running the query. " . mysqli_error($con);
          }
        }
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <script src="../Components/main.js"></script>

</body>

</html>