<?php 
include 'connect.php';

if (isset($_POST['submit'])) {
    
    $title = $_POST['title'];
    $description = $_POST['des'];
    $price = $_POST['price'];

    if(isset($_FILES["cimage"]) && $_FILES["cimage"]["error"] == 0 && isset($_FILES['cvideo'])) {
        $image = $_FILES["cimage"]["tmp_name"];
        $imageBinary = base64_encode(file_get_contents($image));
        $video = $_FILES['cvideo'];
        $allowedTypes = ['video/mp4', 'video/webm', 'video/ogg']; 
        if (!in_array($video['type'], $allowedTypes)) {
            die('Invalid video format.');
        }
        $videocontent = base64_encode(file_get_contents($video['tmp_name']));
        $sql = "INSERT INTO courses(title,description,price,image,overview) VALUES ('$title', '$description', '$price','$imageBinary','$videocontent')";
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
    <div class="container shadow mt-5 pt-5">
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
            <label for="title">Title</label><br>
            <input type="text" name="title" id="Title" required>
    <br><br>
            <label for="des">Description</label><br>
            <input type="text" name="des" id="des" size="50" required>
            <br><br>
    
            <label for="cprice">Price</label><br>
            <input type="number" name="price" id="cprice">
    <br><br>
            <label for="cimage">cover image</label><br>
            <input type="file" name="cimage" id="cimage">
    <br><br>
    <label for="cvideo">insert a overview video</label><br>
            <input type="file" name="cvideo" id="cvideo">
            <br><br>
            <input type="submit" value="submit" name="submit" class="btn btn-primary mx-auto">
        </form>
    </div>
</body>
</html>