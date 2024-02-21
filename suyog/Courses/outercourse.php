<?php
include 'connect.php';
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
    <div class="box position-absolute shadow ">
      <div class="row  ">
        <div class="col-lg-2">
          <div class="imgc">
            <a href="outercourse.php?categogry='"><img src="image/business.icon.png" alt=""></a>
            <div class="text  pt-2  ">
              <h5>Business</h5>
              <p>783 courses</p>
            </div>


          </div>
        </div>
        <div class="col-lg-2 ">
          <div class="imgc h-100">
            <a href=""><img src="image/creative.icon.png" alt=""></a>
            <div class="text  pt-2  ">
              <h5>Creative & Arts</h5>
              <p>540 courses</p>
            </div>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="imgc h-100 ">
            <a href=""><img src="image/environment.icon.png" alt=""></a>
            <div class="text  pt-2  ">
              <h5>Environment</h5>
              <p>230 courses</p>
            </div>
          </div>
        </div>
        <div class="col-lg-2 ">
          <div class="imgc  h-100">
            <a href=""><img src="image/tech.icon.png" alt=""></a>
            <div class="text  pt-2  ">
              <h5>Tech & Coding</h5>
              <p>785 courses</p>
            </div>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="imgc  h-100 ">
            <a href=""><img src="image/history.icon.png" alt=""></a>
            <div class="text  pt-2  ">
              <h5>History</h5>
              <p>342 courses</p>
            </div>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="imgc  h-100">
            <a href=""><img src="image/literaure.icon.png" alt=""></a>
            <div class="text  pt-2  ">
              <h5>Literature</h5>
              <p>567 courses</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <br><br>
  <section class="mb pt-5 mt-5">
    <div class="container">
      <div class="row g-3">
        <?php
        if ($_SESSION['usertype'] == 'teacher') {

          $sql = "SELECT * FROM courses
              INNER JOIN users
              ON courses.uid=users.user_id
               where courses.uid=" . $_SESSION['loginid'] . "";
          $result = mysqli_query($con, $sql);
          if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo '
              <div class="col-4">
              <div class="card bg-body-secondary" style="width: 20rem;" onmouseover="dis()">
              <div class="card-head card-img-top" style="height:15rem;">
                <img src="data:image/jpeg;base64,' . $row["image"] . ' "class="w-100 h-100 object-fit-cover">
                <h2 class=" btn btn-primary price rounded-circle">$' . $row["price"] . '
                </h2>
                <h2 class=" btn btn-transparent cate">
                    <div class="catr position-relative">  <p class="pr">' . $row["category"] . '
                    </p>
               </div>
             
                </h2>
                <a href="innercourse.php?id=' . $row['course_id'] . ' " class="card-link btn btn-dark pre">Preview course</a>
                </div>
       
                    <div class="card-body px-3">
                      <h5 class="card-title">' . $row["title"] . '</h5>
                      <p class="card-text">' . $row["description"] . '</p>
                    </div>
                    <ul class="px-3">
                      <li class=" d-flex justify-content-between">Published by:<img src="data:image/jpeg;base64,' . $row["userimage"] . '"class="rounded-circle object-fit-cover " height="30" width="30"> ' . $row["username"] . '</li>
                      <li class=" d-flex justify-content-between"><p><i class="bi bi-clock-fill pe-2"></i>' . $row["duration"] . 'hrs</p>
                      ';
                                    $cid = $row["course_id"];
                                    $sqli = 'SELECT COUNT(user_id) AS total_students FROM student_courses WHERE course_id = " ' . $cid . ' " ';
                                    $resulti = mysqli_query($con, $sqli);
                                    if ($resulti) {
    
                                        while ($rowi = mysqli_fetch_assoc($resulti)) {
                                            echo '
                      <P><i class="bi bi-people-fill pe-2"></i>' . $rowi["total_students"] . ' students</P>
                      </li>
                      ';
                                        }
                                    }
                                    echo '
                                  
                      
            

        
                      
                       
                           
                                 <li class=" d-flex justify-content-between">
                                 <a href="../course-form/updatecourse.php?id=' . $row['course_id'] . ' " class="btn btn-primary">Edit</a>                 
                                 <a href="deletecourse.php?id=' . $row['course_id'] . '" class="btn btn-danger">Delete</a>
                                </li>
                          </ul>
                      </div>
                      </div>

                    ';

            }
          }
        } elseif ($_SESSION['usertype'] == 'student') {
          $id = $_SESSION['loginid'];
          $sql = "SELECT *
              FROM courses
              INNER JOIN student_courses AS sc_courses
              ON courses.course_id = sc_courses.course_id
         
              WHERE sc_courses.user_id = '$id'";

          $result = mysqli_query($con, $sql);
          if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo '
              <div class="col-4">
              <div class="card bg-body-secondary" style="width: 20rem;" onmouseover="dis()">
              <div class="card-head card-img-top" style="height:15rem;">
                <img src="data:image/jpeg;base64,' . $row["image"] . ' "class="w-100 h-100 object-fit-cover">
                <h2 class=" btn btn-primary price rounded-circle">$' . $row["price"] . '
                </h2>
                <h2 class=" btn btn-transparent cate">
                    <div class="catr position-relative">  <p class="pr">' . $row["category"] . '
                    </p>
               </div>
             
                </h2>
                <a href="innercourse.php?id=' . $row['course_id'] . ' " class="card-link btn btn-dark pre">Preview course</a>
                </div>
       
                    <div class="card-body px-3">
                      <h5 class="card-title">' . $row["title"] . '</h5>
                      <p class="card-text">' . $row["description"] . '</p>
                    </div>
                    <ul class="px-3">
                    ';
              $cid = $row["course_id"];
              $sqli = 'SELECT * from courses 
                            INNER JOIN users
                            ON courses.uid=users.user_id
                            WHERE courses.course_id="' . $cid . '"';
              $resulti = mysqli_query($con, $sqli);
              if ($resulti) {
                while ($rowi = mysqli_fetch_assoc($resulti)) {
                  echo '
                          <li class="d-flex justify-content-between>Published by:<img src="data:image/jpeg;base64,' . $rowi["userimage"] . '"class="rounded-circle object-fit-cover " height="30" width="30"> ' . $rowi["username"] . '</li>
                          ';
                }
              }
                echo '
                      <li class=" d-flex justify-content-between"><p><i class="bi bi-clock-fill pe-2"></i>' . $row["duration"] . 'hrs</p>
                      ';
                                    $cid = $row["course_id"];
                                    $sqli = 'SELECT COUNT(user_id) AS total_students FROM student_courses WHERE course_id = " ' . $cid . ' " ';
                                    $resulti = mysqli_query($con, $sqli);
                                    if ($resulti) {
    
                                        while ($rowi = mysqli_fetch_assoc($resulti)) {
                                            echo '
                      <P><i class="bi bi-people-fill pe-2"></i>' . $rowi["total_students"] . ' students</P>
                      </li>
                      ';
                                        }
                                    }
                                    echo '
                                    </ul>
                      
                  </div>
                  </div>
                ';
                
              }
            }

          }
        
        ?>
      </div>
    </div>
    </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <script src="../Components/main.js"></script>

</body>

</html>
