<?php
include 'connect.php';
session_start();
if (isset($_POST['submit'])) {
    $user_name = $_POST['uname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['pconfirm'];
    if (isset($_FILES["pimage"]) && $_FILES["pimage"]["error"] == 0) {
        $image = $_FILES["pimage"]["tmp_name"];
        $imageBinary = base64_encode(file_get_contents($image));
    }
    if ($password === $cpassword) {
        $sql = "INSERT INTO users(username, email, password,usertype,userimage)
                VALUES('$user_name', '$email', '$password','Admin','$imageBinary')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo '
            <script>
            alert("successfull registration,please login") ;   
            </script> 
            ';
            header("location: ../Home/index.php");
        } else {
            echo 'register problem';
        }

    } else {
        echo "Error in running the query. " . mysqli_error($con);
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sign up | Bootstrap Simple Admin Template</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/auth.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>
    <div class="wrapper">
        <div class="auth-content">
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-4">
                    <img src="https://marketplace.canva.com/EAFauoQSZtY/1/0/1600w/canva-brown-mascot-lion-free-logo-qJptouniZ0A.jpg"
                        alt="" id="logo" height="100" width="300" class="object-fit-cover">                    </div>
                    <h6 class="mb-4 text-muted">Create new account</h6>
                    <form action="<?php $_SERVER['PHP_SELF'] ?>"
        name="form1" method="POST" enctype="multipart/form-data">
                        <div class="mb-3 text-start">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" placeholder="Enter Name"  name ="uname" required>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="email" class="form-label">Email adress</label>
                            <input type="email" class="form-control" placeholder="Enter Email"  name ="email"required>
                        </div>
                        <div class="mb-3 text-start">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" placeholder="Password"  name ="password"required>
                        </div>
                        
                        <div class="mb-3">
                            <input type="password" class="form-control" placeholder="Confirm password" name ="pconfirm" required>
                        </div>
                        <br>
                        <div class="mb-3 text-start">
                        <label for="pimage">Choose a profile picture</label><br>
                    <input type="file" name="pimage" id="pimage" class="rounded">
</div>
                    <br><br> 
                    <input type="submit" name="submit" value="submit" class="btn btn-primary shadow-2 mb-4" required><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>