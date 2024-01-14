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
    <link rel="stylesheet" href="../Components/css/style.css">


</head>

<body>

  <?php include '../Components/Navbar.php';?>
  <div class="container">
    <div class="row">
      <?php
      $sql = "SELECT * FROM courses";
      $result = mysqli_query($con, $sql);
      if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo '
      <div class="col-4">
        <div class="card" style="width: 18rem;">
        <img src="data:image/jpeg;base64,' . $row["image"] . '"class="card-img-top w-100">
            <div class="card-body">
              <h5 class="card-title">' . $row["title"] . '</h5>
              <p class="card-text">' . $row["description"] . '</p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">'. $row["price"].'</li>
              <li class="list-group-item">A second item</li>
              <li class="list-group-item">A third item</li>
            </ul>
            <div class="card-body">
              <a href="#" class="card-link">View all information</a>
              <a href="innercourse.php?id='. $row['cid'].' " class="card-link">Another link</a>
              </div>
          </div>
          </div>
        ';
        }
      }
      ?>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
<script src="../Components/main.js"></script>

</body>

</html>