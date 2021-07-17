<?php
session_start();
  if(!isset($_SESSION['email']))
    {
      $icon1 = "&#xf007;";
      $option1 = "Sign Up";
      $link1 = "signUp.php";
      $icon2 = "&#xf090;";
      $option2 = "Log In";
      $link2 = "logIn.php";
    }else{
      $icon1 = "&#xf013;";
      $option1 = "Change Password";
      $link1 = "changePassword.php";
      $icon2 = "&#xf090;";
      $option2 = "Log Out";
      $link2 = "logOut.php";
    }
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width = device-width, initial-scale= 1.0">
  <title>Outlay</title>

  <!--Bootstrap Link-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
  <!--Bootstrap Bundle with Popper-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8"
    crossorigin="anonymous"></script>

  <!--Separate Popper and Bootstrap JS-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ"
    crossorigin="anonymous"></script>

  <!--CSS Stylesheet Link-->
  <link href="static/customStyle.css" rel="stylesheet" type="text/css">

  <!--font awesome 4 icon links-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
</head>

<body>

  <?php
    require 'database_connection.php';
  ?>


  <!--Navigation Bar-->
  <nav class="navbar navbar-expand-lg navbar-light ms-auto">
    <div class="container">
      <a class="navbar-brand" href="index.php">Outlay</a>
      <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarId">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarId">
        <ul class="navbar-nav ms-auto text-center">
          <li class="nav-item">
            <a class="nav-link" href="about.php"><i class="fa">&#xf05a;</i> About Us</a>
          </li>
          <?php 
               echo "<li class='nav-item'>
                      <a class='nav-link' href='$link1'><i class='fa'>$icon1</i> $option1</a>
                      </li>
                      <li class='nav-item'>
                        <a class='nav-link' href='$link2'><i class='fa'>$icon2</i> $option2</a>
                      </li>";
            ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!--Body-->
  <div class="aboutBody">
    <div class="container row pt-5 m-auto">
      <div class="col-6">
        <h4>Who are we?</h4>
        <span class="container">
          <p>We are a group of young technocrats who came up with an idea of solving budget and time issues which we
            usually face in our daily lives. We are here to provide a budget controller according to your aspects.</p>
          <p>Budget control is the biggest financial issue in the present world. One should look after their budget
            control to get ride off from their financial crisis.</p>
        </span>
      </div>
      <div class="col-6">
        <h4>Why choose us?</h4>
        <span class="container">
          <p>We provide with a predominant way to control and manage your budget estimations with ease of accessing for
            multiple users.</p>
        </span>
      </div>
      <div class="col-6">
        <h4>Contact Us</h4>
        <span class="container">
          <p>Email: perDiem@gmail.com</p>
          <p>Mobile: +91-9876543210</p>
        </span>
      </div>
    </div>
  </div>

  <!--Footer-->
  <footer class="footer container-fluid text-center">
    <span>Copyright © Control Budget. All Rights Reserved | Contact Us: +91-9876543210.</span>
  </footer>

</body>

</html>