<?php
include 'connect.php';

session_start();
if (isset($_POST['submit'])) {
    $user_name = $_POST['uname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['pconfirm'];
    $usertype = $_POST['logintype'];

    if (isset($_FILES["pimage"]) && $_FILES["pimage"]["error"] == 0) {
        $image = $_FILES["pimage"]["tmp_name"];
        $imageBinary = base64_encode(file_get_contents($image));
    }
    if ($password === $cpassword) {
        $sql = "INSERT INTO users(username, email, password,usertype,userimage)
                VALUES('$user_name', '$email', '$password','$usertype','$imageBinary')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo '
            <script>
        
        alert("successfull registration,please login") ;   
                </script> 
                ';
        } else {
            echo 'register problem';
        }

    } else {
        echo "Error in running the query. " . mysqli_error($con);
    }
}
?>

<!-- for login -->
<?php
include 'connect.php';
if (isset($_POST['lsubmit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (!empty($email) && !empty($password)) {
        $sql = " SELECT * FROM users where email='$email' AND password ='$password'";
        $result = mysqli_query($con, $sql);
        $num = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        if ($num > 0) {
            $_SESSION['loginid'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];

            $_SESSION['login'] = true;
            $_SESSION['user'] = $email;
            $_SESSION['usertype'] = $row['usertype'];
            $_SESSION['userimage'] = $row['userimage'];
        }
         else {
            $invalid="Invalid username or password";

        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css
">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header class="">
        <nav class="navbar navbar-expand-lg bg-body-transparent" id="small-sc">
            <div class="container-lg">
                <a class="navbar-brand" href="#">
                    <img src="https://marketplace.canva.com/EAFauoQSZtY/1/0/1600w/canva-brown-mascot-lion-free-logo-qJptouniZ0A.jpg"
                        alt="" id="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../Home/index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../about-us-/index.php">About us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../Courses/allcourses.php">Courses</a>
                        </li>
                    </ul>
                    <form class="d-lg-flex gap-4  d-none" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-primary" type="submit">Search</button>
                    </form>


                    <?php
                    if (isset($_SESSION['login']) && $_SESSION['login']) {
                        echo '
                       <div class="ms-3">
                            <ul class="navbar-nav">
                       <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
        <img src="data:image/jpeg;base64,' . $_SESSION["userimage"] . '"class="rounded-circle object-fit-cover" height="30" width="30">
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Hi ' . $_SESSION["username"] . '</a></li>
                                <li><a class="dropdown-item" href="../Courses/cp.php?id=' . $_SESSION["loginid"] . '">Edit profile</a></li>
                                ';
                                if (($_SESSION['usertype']) == "teacher"||($_SESSION['usertype'])=="student") {
                                    echo '
                                    <li><a class="dropdown-item" href="../Courses/outercourse.php?id=' . $_SESSION["loginid"] . '">Your courses</a></li>
                                    ';
                                    
                                }
                        if (($_SESSION['usertype']) == "teacher") {
                            echo '
                                <li><a class="dropdown-item" href="../course-form/forms.php?id=' . $_SESSION["loginid"] . '"> ADD Your courses</a></li>
';
                        } else {
                            echo '';
                        }
                        if (($_SESSION['usertype']) == "Admin") {
                            echo '
                                <li><a class="dropdown-item" href="../Users/index.php?id=' . $_SESSION["loginid"] . '"> Admin page</a></li>
';
                        } else {
                            echo '';
                        }
                        echo '
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a  href="../Components/Logout.php" class="dropdown-item" >Logout</a></li>
                            </ul>
                        </li>
                        </ul>
                        </div>

                           ';


                    } else {

                        echo '
                            <button class="btn btn-primary mt-sm-3 mt-lg-0 mx-lg-3 sign-in">Sign in</button>
                            ';
                    }
                    ?>
                </div>
            </div>

        </nav>

    </header>


    <!-- Login -->
    <div class="login bg-dark ps p-5 rounded " 
    <?php  if (isset($invalid)){
          echo'style="display:block";'; 
    }
    else{
        echo'style="display:none";'; 
    }
        ?> >
         
        <i class="bi bi-x-circle-fill lcr"></i>
        <h1>SIGN IN</h1>
        <br><br>
        <?php 
                    if (isset($invalid)){
                        echo '
                        <div class="bg-danger-subtle text-dark border border-danger border-3 px-3 py-2 w-100">
                        Invalid username or password<br>
                        Please try Again!
                </div>
                        ';
                        
                    }
                    ?>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <label for="email">Email</label><br>
            <div class="position-relative">
            <input type="email" name="email" class="rounded ps-5" required>
            <div class="text-dark fs-4 l">
                        <i class="bi bi-person-circle px-1"></i>
            </div>
             </div>
            <br><br>

            <label for="password">Password</label><br>
            <div class="position-relative">
            <input type="password" class="rounded ps-5"  name="password" required><br><br>
            <div class="text-dark fs-4 l">
                        <i class="bi  bi-key px-1"></i>
            </div>
                </div>
            <input type="submit" name="lsubmit" value="Login" class="btn btn-danger" required><br><br>

            <p>new user?</p><a href="" class="btn btn-outline-primary reg">Register
                here
            </a></p>
       
        </form>

    </div>


    <!-- Register -->
    <div class="register  ps  rounded bg-light text-dark">
        <i class="bi bi-x-circle-fill rcr"></i>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" onsubmit="return CheckPassword(document.form1.password)"
        name="form1" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-6">
                    <img src="../Components/register.jpg" alt="" class="w-100 object-fit-content h-100">
                </div>
                <div class="col-6 pb-3">
                    <h1 class="mt-4">Register</h1>
        <br><br>
                    <div class="position-relative">
                        <input type="text" name="uname" class="rounded ps-5" placeholder="Username" autofocus required>
                        <div class="text-dark fs-4 l">
                        <i class="bi bi-person-circle px-1"></i>
                        </div>
                    </div>
                    <br>
                    <div class="position-relative">
                    <input type="email" name="email" class="rounded ps-5" placeholder="Email" required>
                    <div class="fs-4 l">
                        <i class="bi bi-envelope-check px-1"></i>
                     </div>    
                </div>
                <br>
                <div class="position-relative">

                    <input type="password" class="rounded password ps-5" id="password" name="password"  placeholder="Password"required>
                    <div class="fs-4 l">
                        <i class="bi bi-key-fill px-1"></i>
                     </div>  
                </div>    
                <br>
                <div class="position-relative">
            
                    <input type="password" name="pconfirm" id="pconfirm" class="rounded ps-5" placeholder="Confirm Password">
                    <div class="fs-4 l">
                        <i class="bi bi-key-fill px-1"></i>
                     </div>  
                </div>
                    <br>
                    
                    <label for="pconfirm ms-4">Login as</label><br>
                    <input type="radio" name="logintype" id="teacher" class="rd ms-2 mt-2" value="teacher"> <label for="teacher">
                         Teacher
                    </label><br>
                    <input type="radio" name="logintype" id="student" class="rd ms-2 mt-2" value="student"> <label for="student">
                         Student
                    </label>
                    <br><br>
                    <label for="pimage">Choose a profile picture</label><br>
                    <input type="file" name="pimage" id="pimage" class="rounded"><br><br>
                    <input type="submit" name="submit" value="submit" class="but rounded" required><br>
                </div>

            </div>
        </form>
    </div>


    <script src="./main.js">
    </script>
</body>

</html>