<?php
  session_start();
  if(!isset($_SESSION['email']))
    {
        header('location: logIn.php');
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

    <?php require 'database_connection.php'; ?>

  <!--Navigation Bar-->
  <nav class="navbar navbar-expand-lg navbar-light ms-auto">
    <div class="container">
      <div class="navbar-brand">Outlay</div>
      <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarId">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarId">
        <ul class="navbar-nav ms-auto text-center">
          <li class="nav-item">
            <a class="nav-link" href="about.php"><i class="fa">&#xf05a;</i> About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="changePassword.php"><i class='fa'>&#xf013;</i> Change Password</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logOut.php" name="logout"><i class="fa">&#xf08b;</i> Log Out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!--Home Body-->
  <div class="bodyMain home-plan-body" style="background-color: #00000026;">

    <div class="container header row mt-2">
      <h1 class="col-10">Your plans</h1>
      <button class="col-1 fa addButton btn-light" title="Click to create a new plan."><a href="createNewPlan.php">&#xf067;</a></button>
    </div>
    <div class="container card-plan-home mt-4 flex">

      <?php 
        homePlans($_SESSION['email']);
        for ($i=0; $i< $_SESSION['count']; $i++){
          //$_SESSION['current-title'] = $_SESSION['arraytitle'][$i];
          echo "<div class='card card-plan m-2'>
                  <div class='card-header'> 
                    ". $_SESSION['arraytitle'][$i] ." 
                    <span class='right-float'> <i class='fa'>&#xf007;</i> ". $_SESSION['arraypeople'][$i] ."</span> </div>
                  <div class='card-body-home-plan'>
                    <div> Budget:  <span class='right-float'>Rs. " . $_SESSION['arraybudget'][$i] ."</span> </div>
                    <div> Date:  <span class='right-float'>". $_SESSION['arrayfromdate'][$i] ." to ". $_SESSION['arraytodate'][$i] ."</span> </div>
                  </div>
                  <div class='text-center ms-2 me-2 mb-2'>
                    <form method='GET' action='viewPlan.php' ><button class='btn btn-light kButton container-fluid' name='viewPlan' value='$i'>  View Plan </button> </form>
                  </div>
                </div>";
        }
      ?>

    </div>
  </div>

  <!--Footer-->
  <footer class="footer container-fluid text-center">
    <span>Copyright © Control Budget. All Rights Reserved | Contact Us: +91-9876543210.</span>
  </footer>

</body>

</html>