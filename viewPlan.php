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
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
    integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
    integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
    crossorigin="anonymous"></script>

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
  <?php
      $remainingAmt = $_SESSION['remaining_amount'];
        if ($remainingAmt >0)
          $fontColor = "text-success";
        else if ($remainingAmt <0)
          $fontColor = "text-danger";
        else
          $fontColor = "text-dark";
  ?>
  <div class="bodyMain home-plan-body" style="background-color: #00000026;">

    <div class="container mt-4 row view-change">
      <div class="col-9">
        <div class='card card-into card-view-plan m-2'>
          <div class='card-header'>
            <span> <?php echo $_SESSION['title']; ?> </span>
            <span class='right-float'>
              <i class='fa'>&#xf007;</i> <?php echo $_SESSION['people']; ?>
            </span>
          </div>
          <div class='card-body-home-plan'>
            <div> Budget: <span class='right-float'> <?php echo "Rs. " . $_SESSION['initialbudget']; ?> </span>
            </div>
            <div> Remaining Amount: <?php echo "<span class='right-float $fontColor'>
                Rs. " . $remainingAmt; ?>
              </span>
            </div>
            <div> Date: <span class='right-float'> <?php echo  $_SESSION['fromdate'] ." to ".$_SESSION['todate']; ?>
            </div>
          </div>

        </div>
      </div>
      <div class="col-3 text-center m-auto">
        <!--<div class='text-center mb-4'>-->
          <button type="button" class='btn btn-light add-expense-button kButton ' data-toggle="modal" data-target="#addExpense">Add New
            Expense
          </button>
        </div>
    </div>

    <div class="container flex">
      <?php
        
        for( $i =0; $i< $_SESSION['row'] ; $i++){
         echo "<div class='card card-into m-2'>
                 <div class='card-header'>". $_SESSION['arrayExpenseTitle'][$i] ."</div>
                 <div class='card-body-home-plan'>
                   <div> Amount:  <span class='right-float'>Rs. " . $_SESSION['arrayExpenseAmount'][$i] ."</span> </div>
                   <div> Paid by:  <span class='right-float'>". $_SESSION['arrayPaidBy'][$i] ."</span> </div>
                   <div> Paid on:  <span class='right-float'>". $_SESSION['arrayPaidOn'][$i] ."</span> </div>
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


  <!--modal-->
  <div class="modal fade" id="addExpense" role="dialog">
    <div class="modal-dialog" style="font-size: 1rem;">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h5 class="modal-title">Add New Expense</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>

        <form method="POST" action="" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group mb-2">
              <label for="Title" class="form-label">Title</label>
              <input type="text" class="form-control" id="Title" name="ename"
                placeholder="Expense Name (Ex: Hotel rent)" title="Please enter expense name here" required>
            </div>
            <div class="form-group mb-2">
              <label for="Date" class="form-label">Date</label>
              <input type="text" class="form-control" id="Date" name="date" placeholder="yyyy-mm-dd"
                title="Please enter date here" required>
            </div>
            <div class="form-group mb-2">
              <label for="Amount-Spent" class="form-label">Amount Spent</label>
              <input type="text" class="form-control" id="Amount-Spent" name="amount-spent" placeholder="Amount Spent"
                title="Please enter amount spent here" required>
            </div>
            <div class="mb-2">
              <label for="Spent-By" class="form-label">Amount Spent by</label>
              <select class="form-select" id="Spent-By" aria-label="Default select example" name="name" required>
                <option selected>Choose Person</option>
                <?php
                    peopleName($_SESSION['email'], $_SESSION['title']);
                    for($i=0; $i< $_SESSION['qtyPeo']; $i++){
                      $name = $_SESSION['arrayPeopleName'][$i];
                      echo "<option value='$name'>". $name ."</option>";
                    }
                  ?>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-light index-button  kButton" name="addNewExpense">Add</button>
            <button type="reset" class="btn btn-light index-button kButton" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</body>

</html>