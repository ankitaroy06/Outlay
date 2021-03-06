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
      <div class="navbar-brand" href="index.php">Outlay</div>
      <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarId">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarId">
        <ul class="navbar-nav ms-auto text-center">
          <li class="nav-item">
            <a class="nav-link" href="about.php"><i class="fa">&#xf05a;</i> About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="signUp.php"><i class='fa'>&#xf007;</i> Sign Up</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logIn.php"><i class="fa">&#xf090;</i> Log In</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!--Sign Up Form Body-->
  <div class="bodyMain">
    <div class="card card-into">
      <h4 class="card-header">Sign Up</h4>
      <form class="forms card-body" action="" method="POST">
        <div class="form-group mb-2">
          <label for="Name" class="form-label">Name :</label>
          <input type="text" class="form-control" id="Name" name="name" placeholder="Name" title="Please enter your name here" required>
        </div>
        <div class="form-group mb-2">
          <label for="Email" class="form-label">Email :</label>
          <input type="email" class="form-control" id="Email" name="email" placeholder="Enter Valid Email" title="Please enter your email here" required>
        </div>
        <div class="form-group mb-2">
          <label for="Password" class="form-label">Password :</label>
          <input type="password" class="form-control" id="Password" name="password" placeholder="Password (Min. 6 characters)" title="Please enter valid password here" required>
        </div>
        <div class="form-group mb-3">
          <label for="Telephone" class="form-label">Phone Number :</label>
          <input type="tel" class="form-control" id="Telephone" name="telephone"
            placeholder="Enter Valid Phone Number (Ex: 8448444853)" title="Please enter valid phone number here" required>
        </div>
        <div class="text-center">
          <button type="submit" name="signup" class="btn btn-light kButton container-fluid">Submit</button>
        </div>
      </form>
    </div>
  </div>

  <!--Footer-->
  <footer class="footer container-fluid text-center">
    <span>Copyright ?? Control Budget. All Rights Reserved | Contact Us: +91-9876543210.</span>
  </footer>

</body>

</html>