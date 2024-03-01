<?php
include 'connect.php';
if (isset($_POST['csubmit'])) {
  $user_name = $_POST['usernameu'];
  $utype=$_POST['utype'];
  $email = $_POST['uemail'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];
  $hashedpassword = password_hash($cpassword, PASSWORD_DEFAULT);
  $id = $_POST['uid'];
  if (isset($_FILES["pimage"]) && $_FILES["pimage"]["error"] == 0) {
    $image = $_FILES["pimage"]["tmp_name"];
    $imageBinary = base64_encode(file_get_contents($image));
  }
  $sqli = "SELECT * FROM users WHERE email='$email' and user_id!='$id'";
  $resulti = mysqli_query($con, $sqli);
  if (mysqli_num_rows($resulti) > 0) {

    $cpemailerror = "Email Already exists.";
  } else {
    $sqlu = "SELECT * FROM users WHERE username='$user_name' and user_id!='$id'";
    $resultu = mysqli_query($con, $sqlu);
    if (mysqli_num_rows($resultu) > 0) {

      $cpnameerror = "Username Already exists.";
    } else {
      if ($password == $cpassword) {
        $sql = "UPDATE users
      SET
       username='$user_name',
        email='$email',
       password='$hashedpassword',
       userimage='$imageBinary'
        WHERE user_id='$id';
        ";
        $result = mysqli_query($con, $sql);
        if ($result) {
          echo '
          <script>
      alert("successfully Updated") ;   
         </script>   
              ';
          if ($utype == "teacher" || $utype == "student") {
            header("Location:../Components/Logout.php");

          } else {
            header('Location: ../Users/index.php?id=' . $uid);
          }
        } else {
          echo '
          <script>
          alert("Update  problem");
          </script>';
        }

      } else {
        $cperror = "Check the password and try again";
      }
    }
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Change profile</title>
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
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
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
           
          <form action="?id=' . $id . '" method="POST" enctype="multipart/form-data" >

            <img src="data:image/jpeg;base64,' . $row["userimage"] . '"class="rounded-circle object-fit-cover" height="80" width="80">
            <br>

            <label for="pimage">Change a profile picture</label><br>
            <input type="file" name="pimage" id="pimage" class="rounded" value="' . $row["userimage"] . '"><br><br>
            <div class="mb-3">
            <label for="username" class="form-label">Change Name</label>
            <div class=" w-70 pe">';
        if (isset($cpnameerror)) {
          echo '
                      Name already exists!
                      ';
        } else {
          echo '';
        }
        echo '
                  </div>
                <input type="text" name="usernameu" placeholder="' . $row["username"] . '" value="' . $row["username"] . '" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class=" w-70 pe">';
        if (isset($cpemailerror)) {
          echo '
                Email already exists!
                ';
        } else {
          echo '';
        }
        echo '</div>
          
                <input type="email" name="uemail" placeholder=" ' . $row["email"] . '" value="' . $row["email"] . '"class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password"  class="form-control" required>
              </div>
              <div class="mb-3">
              <label for="password" class="form-label"> Confirm Password</label>
              <div class=" w-70 pe">';
        if (isset($cperror)) {
          echo '
                Check the password an try again
                              ';
        } else {
          echo '';
        }
        echo '
                          </div>
              <input type="password" name="cpassword" placeholder="Confirm password" class="form-control" required>
            </div>
            <input type="hidden" name="uid" value="' . $id . '">
            <input type="hidden" name="utype" value="' . $_SESSION['usertype']. '">

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
      }
    }
  }
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <script src="../Components/main.js"></script>

</body>

</html>