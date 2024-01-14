<?php
include 'connect.php';

session_start();
if (isset($_POST['submit'])) {
    $user_name = $_POST['uname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['pconfirm'];

    if ($password === $cpassword) {
        $sql = "INSERT INTO users(username, email, password)
                VALUES('$user_name', '$email', '$password')";
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
        if ($num > 0) {
            // session_start();
            $_SESSION['login'] = true;
            $_SESSION['user'] = $email;
            echo '';
        } else {
            echo "";
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
        <nav class="navbar navbar-expand-lg bg-body-transparent">
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
                            <a class="nav-link active" aria-current="page" href="../Home/index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../about-us-/index.php">About us</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Courses
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Politics</a></li>
                                <li><a class="dropdown-item" href="#">History</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">See more</a></li>
                            </ul>
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
                                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" class="rounded-circle" height="30" width="30" alt="">
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Hi</a></li>
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
    <div class="login bg-dark ps p-5 rounded ">
        <i class="bi bi-x-circle-fill lcr"></i>
        <h1>SIGN IN</h1>
        <br><br>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <label for="email">Email</label><br>
            <input type="email" name="email" class="rounded" required><br><br>
            <label for="password">Password</label><br>
            <input type="password" class="rounded" name="password" required><br><br>
            <input type="submit" name="lsubmit" value="Login" class="btn btn-danger" required><br><br>

            <p>new user?</p><a href="" class="btn btn-outline-primary reg">Register
                here
            </a></p>

        </form>

    </div>

    <div class="register bg-dark ps p-5 rounded">
        <i class="bi bi-x-circle-fill rcr"></i>
        <h1>Register</h1>
        <br><br>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <label for="uname">Username</label><br>
            <input type="text" name="uname" class="rounded" autofocus required><br><br>
            <label for="email">Email</label><br>
            <input type="email" name="email" class="rounded" required><br><br>
            <label for="password">Password</label><br>
            <input type="password" class="rounded" name="password" required><br><br>
            <label for="pconfirm">Password Confirmation</label><br>
            <input type="password" name="pconfirm" class="rounded"><br><br>
            <input type="submit" name="submit" value="submit" class="but rounded" required><br>
        </form>
    </div>
 

    <script src="./main.js">
    </script>
</body>

</html>