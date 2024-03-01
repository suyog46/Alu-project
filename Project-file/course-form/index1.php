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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css
">
</head>

<body>
    <?php

    echo '


    <div class="container shadow mt-5 pt-5 ">
        <form action="' . $_SERVER["PHP_SELF"] . '" method="POST" enctype="multipart/form-data" >
            <label for="title">Title</label><br>
            <input type="text" name="title" id="Title" required>

            <br><br>
            <label for="des">Description</label><br>
            <textarea id="des" name="des" rows="4" cols="40" placeholder="Describe the overview of the course"></textarea>

            <br><br>
            <label for="detaildes">Give the detail description</label><br>
            <textarea id="detaildes" name="detaildes" rows="8" cols="40" placeholder="Describe in detail about this course"></textarea>
               
                        <br><br>

            <label for="cprice">Price</label><br>
            <input type="number" name="price" id="cprice">

            <br><br>
            <label for="category">Select the category:</label>
            <select  id="category" name="category">
            <option value="programming">Programming</option>
            <option value="politics">Politcs</option>
            <option value="art">Art</option>
            <option value="business">Business</option>
            <option value="languages">Languages</option>
            <option value="others">Others</option>

        </select>
        <br><br>
            <label for="cd">Duration</label><br>
            <input type="number" name="cd" id="cd">

            <br><br>

            <label for="">Course level</label><br>
            <label for="bg">Beginner</label>
            <input type="radio" name="cl" id="bg" value="Beginner">
            <label for="im">Intermediate</label>
            <input type="radio" name="cl" id="im" value="Intermediate">
            <label for="pr">Professional</label>
            <input type="radio" name="cl" id="pr" value="Professional">

            <br><br>
            <label for="lg"> Course Language :</label>
            <select id="lg" name="language">
                <option value="English">English</option>
                <option value="Nepali">Nepali</option>
                <option value="Hindi">Hindi</option>
            </select>
            <br><br>
            <label for="cimage">cover image</label><br>
            <input type="file" name="cimage" id="cimage">
            <br><br>
            <label for="cvideo">insert a overview video</label><br>
            <input type="file" name="cvideo" id="cvideo">
            <br><br>
            <label for="who">Give the detail description</label><br>
                        <textarea id="who" name="who" rows="8" cols="40" placeholder="Describe in detail about the targetted audience"></textarea>
            <br>
            <br>
            <label for="ay">About yourself</label><br>
            <textarea id="longText" name="ay" rows="8" cols="40" placeholder="Describe about yourslef as a instructor in this course"></textarea>
<br><br>
            <input type="submit" value="submit" name="submit" class="btn btn-primary mx-auto">
        </form>
    </div>
    ';
    ?>
</body>

</html>