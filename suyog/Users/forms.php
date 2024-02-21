<?php
include 'connect.php';

if (isset($_POST['submit'])) {

    $title = $_POST['title'];
    $description = $_POST['des'];
    $price = $_POST['price'];
    $duration = $_POST['cd'];
    $courselevel = $_POST['cl'];
    $language = $_POST['language'];
    $about = $_POST['ay'];
    $detaildes = $_POST['detaildes'];
    $who = $_POST['who'];
    $category = $_POST['category'];
    if (isset($_FILES["cimage"]) && $_FILES["cimage"]["error"] == 0 && isset($_FILES['cvideo']) && $_FILES["cvideo"]["error"] == 0) {
        $image = $_FILES["cimage"]["tmp_name"];
        $imageBinary = base64_encode(file_get_contents($image));
        $videoname = $_FILES['cvideo']['name'];
        $videotemp = $_FILES['cvideo']['tmp_name'];
        $folder = "../Videos/" . $videoname;
        move_uploaded_file($videotemp, $folder);

        // if (!in_array($video['type'], $allowedTypes)) {
        //     die('Invalid video format.');
        // }
        session_start();
        $uid = $_SESSION["loginid"];

        $sql = "INSERT INTO courses(uid,title,description,price,image,overview,duration,courselevel,language,aboutyourself,detaildescription,targetaudience,category) VALUES ('$uid','$title', '$description', '$price','$imageBinary','$videoname','$duration','$courselevel','$language','$about','$detaildes','$who','$category')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo 'Successfully inserted';
        } else {
            echo 'Unsuccessful insertion: ';
        }
    } else {
        echo 'Error uploading file.';
    }
}
?>

<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Forms | Bootstrap Simple Admin Template</title>
    <link href="assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/master.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <!-- sidebar navigation component -->
        <nav id="sidebar" class="active">
            <div class="sidebar-header">
                <img src="assets/img/bootstraper-logo.png" alt="bootraper logo" class="app-logo">
            </div>
            <ul class="list-unstyled components text-secondary">
                <li>
                    <a href="dashboard.html"><i class="fas fa-home"></i>Dashboard</a>
                </li>
                <li>
                    <a href="forms.html"><i class="fas fa-file-alt"></i>Forms</a>
                </li>
                <li>
                    <a href="tables.html"><i class="fas fa-table"></i>Tables</a>
                </li>
                <li>
                    <a href="charts.html"><i class="fas fa-chart-bar"></i>Charts</a>
                </li>
                <li>
                    <a href="icons.html"><i class="fas fa-icons"></i>Icons</a>
                </li>
                <li>
                    <a href="#uielementsmenu" data-bs-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle no-caret-down"><i class="fas fa-layer-group"></i>UI Elements</a>
                    <ul class="collapse list-unstyled" id="uielementsmenu">
                        <li>
                            <a href="ui-buttons.html"><i class="fas fa-angle-right"></i>Buttons</a>
                        </li>
                        <li>
                            <a href="ui-badges.html"><i class="fas fa-angle-right"></i>Badges</a>
                        </li>
                        <li>
                            <a href="ui-cards.html"><i class="fas fa-angle-right"></i>Cards</a>
                        </li>
                        <li>
                            <a href="ui-alerts.html"><i class="fas fa-angle-right"></i>Alerts</a>
                        </li>
                        <li>
                            <a href="ui-tabs.html"><i class="fas fa-angle-right"></i>Tabs</a>
                        </li>
                        <li>
                            <a href="ui-date-time-picker.html"><i class="fas fa-angle-right"></i>Date & Time Picker</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#authmenu" data-bs-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle no-caret-down"><i class="fas fa-user-shield"></i>Authentication</a>
                    <ul class="collapse list-unstyled" id="authmenu">
                        <li>
                            <a href="login.html"><i class="fas fa-lock"></i>Login</a>
                        </li>
                        <li>
                            <a href="signup.html"><i class="fas fa-user-plus"></i>Signup</a>
                        </li>
                        <li>
                            <a href="forgot-password.html"><i class="fas fa-user-lock"></i>Forgot password</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#pagesmenu" data-bs-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle no-caret-down"><i class="fas fa-copy"></i>Pages</a>
                    <ul class="collapse list-unstyled" id="pagesmenu">
                        <li>
                            <a href="blank.html"><i class="fas fa-file"></i>Blank page</a>
                        </li>
                        <li>
                            <a href="404.html"><i class="fas fa-info-circle"></i>404 Error page</a>
                        </li>
                        <li>
                            <a href="500.html"><i class="fas fa-info-circle"></i>500 Error page</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="users.html"><i class="fas fa-user-friends"></i>Users</a>
                </li>
                <li>
                    <a href="settings.html"><i class="fas fa-cog"></i>Settings</a>
                </li>
            </ul>
        </nav>
        <!-- end of sidebar component -->
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
                                <a href="#" id="nav1" class="nav-item nav-link dropdown-toggle text-secondary"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-link"></i> <span>Quick Links</span> <i style="font-size: .8em;"
                                        class="fas fa-caret-down"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end nav-link-menu" aria-labelledby="nav1">
                                    <ul class="nav-list">
                                        <li><a href="" class="dropdown-item"><i class="fas fa-list"></i> Access Logs</a>
                                        </li>
                                        <div class="dropdown-divider"></div>
                                        <li><a href="" class="dropdown-item"><i class="fas fa-database"></i> Back
                                                ups</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a href="" class="dropdown-item"><i class="fas fa-cloud-download-alt"></i>
                                                Updates</a></li>
                                        <div class="dropdown-divider"></div>
                                        <li><a href="" class="dropdown-item"><i class="fas fa-user-shield"></i>
                                                Roles</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <div class="nav-dropdown">
                                <a href="#" id="nav2" class="nav-item nav-link dropdown-toggle text-secondary"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user"></i> <span>John Doe</span> <i style="font-size: .8em;"
                                        class="fas fa-caret-down"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end nav-link-menu">
                                    <ul class="nav-list">
                                        <li><a href="" class="dropdown-item"><i class="fas fa-address-card"></i>
                                                Profile</a></li>
                                        <li><a href="" class="dropdown-item"><i class="fas fa-envelope"></i>
                                                Messages</a></li>
                                        <li><a href="" class="dropdown-item"><i class="fas fa-cog"></i> Settings</a>
                                        </li>
                                        <div class="dropdown-divider"></div>
                                        <li><a href="" class="dropdown-item"><i class="fas fa-sign-out-alt"></i>
                                                Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- end of navbar navigation -->

            <?php

            echo '
            <div class="content">
                <div class="container">
                    <div class="page-title">
                        <h3>Forms</h3>
                    </div>
                    <div class="row">
                        <h1>ADD a new course</h1>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">Course Overview</div>
                                <div class="card-body">
                                    <h5 class="card-title"></h5>
                                    <form action="' . $_SERVER[" PHP_SELF"] . '" method="POST" enctype="multipart/form-data" >
                                        <div class="mb-3 row">
                                            <label class="col-sm-2">Course title</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="title" id="Title"  class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="line"></div><br>
                                        <div class="mb-3 row">
                                            <label class="col-sm-2">Cover Image</label>
                                            <div class="col-sm-10">
                                                <input type="file" name="cimage" id="cimage"  class="form-control">

                                                <small class="form-text text-muted">Add a cover image for your course</small>
                                            </div>
                                        </div>
                                    </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">Add Course Details</div>
                                            <div class="card-body">
                                        <div class="mb-3 row">
                                            <label class="col-sm-2">cover Description</label>
                                            <div class="col-sm-10">
                                                <textarea id="des" name="des" rows="4" cols="40" class="form-control" placeholder="Describe the overview of the course"></textarea>
                                            </div>
                                        </div>
                                        <div class="line"></div><br>
                                        <div class="mb-3 row">
                                            <label class="col-sm-2">Detail Description</label>
                                            <div class="col-sm-10">
                                                <textarea id="des" name="des" rows="4" cols="40" class="form-control" placeholder="Describe in detail about the course"></textarea>
                                            </div>
                                        </div>
                                        <div class="line"></div><br>
                                        <div class="mb-3 row">
                                            <label class="col-sm-2">Price</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="price" id="cprice" >
                                            </div>
                                        </div>
                                        <div class="line"></div><br>
                                        <div class="mb-3 row">
                                            <label class="col-sm-2">Category</label>
                                            <div class="col-sm-10 select">
                                                <select  id="category" name="category" class="form-select">
                                                    <option value="programming">Programming</option>
                                                    <option value="politics">Politcs</option>
                                                    <option value="art">Art</option>
                                                    <option value="business">Business</option>
                                                    <option value="languages">Languages</option>
                                                    <option value="others">Others</option>
                                                </select>
                                            </div>
                                         
                                        </div>
                                        <div class="line"></div><br>
                                        <div class="mb-3 row">
                                            <label class="col-sm-2">Course duration</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="cd" id="cd">
                                            </div>
                                        </div>
                                        <div class="line"></div><br>

                                        <div class="mb-3 row">
                                            <label class="col-sm-2"> 
                                                Course level
                                            </label>
                                            <div class="col-sm-10">
                                                <div class="">
                                                  <input class="form-check-input" type="radio" name="cl" id="bg" value="Beginner" >
                                                  <label for="bg" class="form-check-label">Beginner</label><br>
                                                  <input class="form-check-input" type="radio" name="cl" id="im" value="Intermediate" >
                                                  <label for="im" class="form-check-label">Intermediate</label><br>
                                                  <input type="radio" class="form-check-input" name="cl" id="pr" value="Professional">
                                                  <label for="pr">Professional</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="line"></div><br>
                                        <div class="mb-3 row">
                                            <label class="col-sm-2" for="lg">Language</label>
                                            <div class="col-sm-10 ">
                                            <select id="lg" name="language" class="form-select">
                                                <option value="English">English</option>
                                                <option value="Nepali">Nepali</option>
                                                <option value="Hindi">Hindi</option>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="line"></div><br>
                                                                        
                                        <div class="mb-3 row">
                                            <label class="col-sm-2">Targetaudience</label>
                                            <div class="col-sm-10">
                                                <textarea id="who" name="who" rows="8" cols="40" placeholder="Describe in detail about the targetted audience" class="form-control"></textarea>
                                            </div>
                                        </div> 
                                          <div class="mb-3 row">
                                            <label class="col-sm-2">About yourself</label>
                                            <div class="col-sm-10">
                                                <textarea id="longText" name="ay" rows="8" cols="40" placeholder="Describe about yourslef as a instructor in this course"></textarea>
                                            </div>
                                        </div>
                                        <div class="line"></div><br>
                                        <div class="mb-3 row">
                                            <div class="col-sm-4 offset-sm-2">
                                                    
                                                <button type="submit"  name="submit" class="btn btn-primary mb-2"><i class="fas fa-save"></i> Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';
            ?>
        </div>
    </div>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/form-validator.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>
                                <!-- <div class="mb-3 row">
                                    <label class="col-sm-2">Input with success</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control is-valid">
                                    </div>
                                </div>
                                <div class="line"></div><br>
                                <div class="mb-3 row">
                                    <label class="col-sm-2">Input with warning</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control is-invalid">
                                    </div>
                                </div>
                                <div class="line"></div><br>
                                <div class="mb-3 row has-danger">
                                    <label class="col-sm-2">Input with error</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control is-invalid">
                                        <div class="invalid-feedback">Read error message here.</div>
                                    </div>
                                </div> -->
                               
                                