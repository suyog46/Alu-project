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
        session_start();
        $uid = $_SESSION["loginid"];
        $sql = "INSERT INTO courses(uid,title,description,price,image,overview,duration,courselevel,language,aboutyourself,detaildescription,targetaudience,category) VALUES ('$uid','$title', '$description', '$price','$imageBinary','$videoname','$duration','$courselevel','$language','$about','$detaildes','$who','$category')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo 'Successfully inserted';
            header('location:../Courses/outercourse.php');
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
    <link href="assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/master.css" rel="stylesheet">
    <link rel="stylesheet" href="../Components/css/style.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

</head>
<body>
    <section class="headf">

         <?php include '../Components/Navbar.php'?>
    </section>
    <div class="wrapper">
    
       
        <div id="body" class="active">
          

            <?php

            echo '
            <div class="content">
                <div class="container">
                   
                    <div class="row">
                        <h1>ADD a new course</h1>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">Course Overview</div>
                                <div class="card-body">
                                    <h5 class="card-title"></h5>
                                    <form action="' . $_SERVER["PHP_SELF"] . '" method="POST" enctype="multipart/form-data" >
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
                                                <textarea id="des" name="detaildes" rows="4" cols="40" class="form-control" placeholder="Describe in detail about the course"></textarea>
                                            </div>
                                        </div>
                                        <div class="line"></div><br>
                                        <div class="mb-3 row">
                                            <label class="col-sm-2">Price</label>
                                            <div class="col-sm-10">
                                                <input type="number" name="price" id="cprice"  class="form-control">
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
                                                <input type="number" name="cd" id="cd"  class="form-control">
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
                                        <div class="mb-3 row">
                                        <label class="col-sm-2">Overview video</label>
                                        <div class="col-sm-10">
                                        <input type="file" name="cvideo" id="cvideo"  class="form-select">
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
                                                <textarea id="longText" name="ay" rows="8" cols="40" placeholder="Describe about yourslef as a instructor in this course"  class="form-control"></textarea>
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
    <script src="../Components/main.js"></script>
</body>

</html>
