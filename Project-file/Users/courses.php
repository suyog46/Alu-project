<?php
include './connect.php';

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tables | Bootstrap Simple Admin Template</title>
    <link href="assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/datatables/datatables.min.css" rel="stylesheet">
    <link href="assets/css/master.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>
<div class="wrapper">
<nav id="sidebar" class="active">
            <div class="sidebar-header">
            <img src="https://marketplace.canva.com/EAFauoQSZtY/1/0/1600w/canva-brown-mascot-lion-free-logo-qJptouniZ0A.jpg"
                        alt="" id="logo" height="40" width="100" class="object-fit-cover">
                                </div>
            <ul class="list-unstyled components text-secondary">
                <li>
                    <?php
                      if(isset($_GET['id'])){
                        $id=$_GET['id'];
                    }
                    echo'
                    <a href="../Users/dashboard.php?id=' . $id . '"><i class="fas fa-home"></i> Dashboard</a>
                   
                </li>
              
                <li>
                    <a href="tables.php?id=' . $id . '"> <i class="bi bi-people-fill"></i>
 Students</a>
                </li>
                <li>
                    <a href="teachers.php?id=' . $id . '"> <i class="bi bi-person-fill-check"></i>Teachers</a>
                </li>
                <li>
                    <a href="Courses.php?id=' . $id . '"><i class="fas fa-icons"></i> Courses</a>
                </li>
                <li>
                    <a href="#authmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle no-caret-down"><i class="fas fa-user-shield"></i> Authentication</a>
                    <ul class="collapse list-unstyled" id="authmenu">
                       
                        <li>
                            <a href="signup.php?id=' . $id . '"><i class="fas fa-user-plus"></i>Add Admin</a>
                        </li>
                    </ul>
                </li>
                <li><a  href="../Components/Logout.php" class="dropdown-item" ><i class="bi bi-box-arrow-in-left"></i>Logout</a></li>
                ';
                ?>
            </ul>
        </nav>
        <div id="body" class="active">
            <!-- navbar navigation component -->
            <nav class="navbar navbar-expand-lg navbar-white bg-white">
                <button type="button" id="sidebarCollapse" class="btn btn-light">
                    <i class="fas fa-bars"></i><span></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ms-auto">
                       
                        <li class="nav-item dropdown">
                            <div class="nav-dropdown">
                                <a href="#" id="nav2" class="nav-item nav-link dropdown-toggle text-secondary" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user"></i> <span>Hello </span> <i style="font-size: .8em;" class="fas fa-caret-down"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end nav-link-menu">
                                    <ul class="nav-list">
                                        <li><a href="signup.php" class="dropdown-item"><i class="fas fa-cog"></i>Add Admin</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- end of navbar navigation -->
            <div class="content">
                <div class="container">
                    <div class="page-title">
                        <h3>All COurses</h3>
                    </div>
                    <div class="row">
                          <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">Courses</div>
                                <div class="card-body">
                                   
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>course_id</th>
                                                    <th>CourseName</th>
                                                    <th>Instructor</th>
                                                    <th>Price</th>
                                                    <th>Course Level</th>
                                                    <th>Course Language</th>
                                                    <th>Course Duration</th>
                                                    
                                                </tr>
                                            </thead>
                                           
                                            <tbody>
                                                <?php

                                                $sql="Select * from courses
                                                    INNER JOIN users
                                                    on users.user_id=courses.uid
                                                    ";
                                                     $result = mysqli_query($con, $sql);
                                                     if (mysqli_num_rows($result)>0) {
                                                     while ($row = mysqli_fetch_assoc($result)) {
                                           
                                             echo' 
                                            
                                            <tr>
                        
                                           <td> '.$row["course_id"].'</td>
                                           <td> '.$row["title"].'</td>
                                           <td> '.$row["username"].'</td>
                                           <td> '.$row["price"].' $</td>
                                           <td> '.$row["courselevel"].'</td>
                                           <td> '.$row["language"].'</td>
                                           <td> '.$row["duration"].' hr</td>
                                           <td> <a href="../Courses/innercourse.php?id=' . $row['course_id'] . ' " class="card-link btn btn-dark pre">Preview Detail</a>
                                           </td>

                                        </tr>
                                        ';
                                                     }
                                                    }

                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                      
                      
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/datatables/datatables.min.js"></script>
    <script src="assets/js/initiate-datatables.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>