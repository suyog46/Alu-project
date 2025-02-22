<?php include 'connect.php';

if (isset($_POST['submit'])) {
    $cid = $_POST['cid'];
    $uid = $_POST['uid'];
    $sql = "INSERT INTO student_courses(user_id,course_id)
    VALUES('$uid','$cid');
    ";
    $result = mysqli_query($con, $sql);
    if ($result) {
        header('location:innercourse.php?id=' . $cid . ' ');
    } else {
        echo 'unsuccessfull';
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="../Components/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<section class="headf">
<?php include '../Components/Navbar.php'?>
</section>
    <?php 
    if(($_SESSION['login'])!=true){
        echo'
        <script>
        alert("please login first!");
         window.location.href="./allcourses.php";

        </script>

        ';

    }
    ?>
    <br><br><br><br>
    <div class="container">
        <?php
        if (isset($_GET['id'])) {

            $id = $_GET['id'];
            $sqle = "SELECT * FROM student_courses where course_id=$id and user_id=".$_SESSION['loginid']."";
            $resulte = mysqli_query($con, $sqle);
            $sql = "SELECT * FROM courses where course_id=$id ";
            $result = mysqli_query($con, $sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {

                    echo '
        <h1 class="fw-bold fs-3">    
        </h1>
        <div class="container  p-5">
            <div class="row ">
                <div class="col-lg-8  shadow p-5">
            <h1 >' . $row["title"] . '</h1>
            <br>
            <video width="730" height="360" controls>
            <source src="../Videos/' . $row["overview"] . '" type="video/mp4">
        </video>
    
                </div>
                <div class="col-lg-4 detail shadow">

                <h1 class="btn  btn-danger "> $' . $row["price"] . '</h1>
                 
                   ';
                    if (($_SESSION['usertype']) == "teacher"||($_SESSION['usertype'])=="Admin") {
                        echo '';

                        
                    } else {
                        echo '
                    <form action="' . $_SERVER["PHP_SELF"] . '" method="POST" enctype="multipart/form-data" >
                    <input type="hidden" name="cid" value="' . $row["course_id"] . ' ">
                    <input type="hidden" name="uid" value="' . $_SESSION['loginid'] . ' ">

        <br><br>';

                        if (mysqli_num_rows($resulte) > 0) {
                            echo ' <p class="btn btn-danger mx-auto">Already enrolled</p>';
                        }
                         else {
                            
                            echo '
                            <input type="submit" value="Enroll this course" name="submit" class="btn btn-primary mx-auto">
                            ';
                        }

                    }
                    echo '
                </form>
                   <div class="info ">

                 <p>  <i class="bi bi-alarm"></i>  Duration : ' . $row["duration"] . ' </p>
                 <p> <i class="bi bi-hand-thumbs-up-fill"></i>  Skill level : ' . $row["courselevel"] . ' </p>
                 <p><i class="bi bi-book"></i> Lecture : ' . $row["language"] . ' </p>
                 ';
                 $cid=$row["course_id"];
                 
                 $sqli = 'SELECT COUNT(user_id) AS total_students FROM student_courses WHERE course_id = " ' .$cid.' " ';
                 $resulti = mysqli_query($con, $sqli);
                 if ($resulti) {
   
                   while ($rowi = mysqli_fetch_assoc($resulti)) {
                   echo'
                   <P>
                 <P><i class="bi bi-people-fill pe-2"></i>'.$rowi["total_students"].' students</P>
                 </p>
                 ';
                 }
               }
               echo'
                 <p><i class="bi bi-translate"></i> language : ' . $row["language"] . ' </p>
                 <p><i class="bi bi-patch-check-fill"></i> Certificate of completion </p>
                   </div>
                </div>
            </div>
        </div>
        <div class="container mt-5 ">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="btn  btn-outline-primary   b1"> Overview
                        </div>
                        <div class="btn btn-outline-primary b2">Curriculum</div>
                        <div class="btn btn-outline-primary b3">Instructor</div>
                    </div>
                    <div class="col-lg-12 t1 pt-3">
                        <h3>Course description</h3>
                        ' . $row["detaildescription"] . '
                  
        <br><br>

                    <h3>Who is this course for</h3>
                    ' . $row["targetaudience"] . '
        
                    </div>
                    <div class="col-lg-12 t2 pt-3">I am text2</div>
                    <div class="col-lg-12 t3 pt-3 ">
                    ';
                    $id=$row['uid'];
                    $sqlo = "SELECT  DISTINCT userimage,username FROM users
                    INNER JOIN courses
                    on users.user_id=courses.uid
                     where user_id=$id ";
                     $resulto=mysqli_query($con,$sqlo);
                     while($row=mysqli_fetch_assoc($resulto)){
                        echo'
                        <div class="row">
                        <div class="col-1">
                        <img src="data:image/jpeg;base64,' . $row["userimage"] . '"class="rounded-circle object-fit-cover" height="100" width="100">
                        <h5>'.$row["username"].'</h5>
                        </div>
                        ';
                     
                    echo'

              
                     
                
                    
                </div>
                </div>
            </div>
   
        </div>
            
      ';
                     }
                }
            }
        }
        ?>




        <script src='main.js'></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
        <script src="../Components/main.js"></script>
</body>

</html>