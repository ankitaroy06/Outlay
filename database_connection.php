<?php

    $server= "localhost";
    $username= "root";
    $password= "";
    $database= "users";

    $_SESSION['con']= $con = mysqli_connect($server, $username, $password, $database);


    $_SESSION['msg'] = $_SESSION['alert']= "";
    //database connnection for SIGN UP FORM VALIDATIONS called from 'signUp.php'
    if(isset($_POST['signup'])){
      $name= $email= $password= $telephone= $token ="";
      $name= mysqli_real_escape_string($con, $_POST['name']);
      $email= mysqli_real_escape_string($con, $_POST['email']);
      $token = substr(sha1(rand()), 0, 15)+$name;

      //email validation (eg: user@gmail.com)
      if(! filter_var($email, FILTER_VALIDATE_EMAIL)){
        ?><script type='text/javascript'> alert('Please enter a valid email.');</script> <?php
      }
  
      //check whether email exist or not
      $emailquery = "SELECT * FROM registeredusers WHERE email='$email' ";
      $emailqueryexe = mysqli_query($con, $emailquery);
      $count = mysqli_num_rows($emailqueryexe);
      if($count != 0)
      {
        ?><script type='text/javascript'> alert('Email already exist.');</script> <?php
      }
  
      $password= mysqli_real_escape_string($con, $_POST['password']);
  
      //password validation (.ie., password > 6 digits)
      if(strlen($password)<6)
      {
        ?><script type='text/javascript'> alert('Please enter password of min. 6 digits.');</script> <?php
      }
      else
        $encrytpassword = md5(md5($password));
  
      $telephone= mysqli_real_escape_string($con, $_POST['telephone']);
  
      //phone number validation (.ie., phone number = 10 digits)
      if( !(preg_match('/^[0-9]{10}+$/', $telephone)) ) //can also use a condition !(strlen($telephone)==10)
      {
        ?><script type='text/javascript'> alert('Please enter valid Phone number.');</script> <?php
      }
  
      //inserting data into database
      $datainsertquery = " INSERT INTO registeredusers (user, email, scode, telephone, token) VALUES ('$name', '$email', '$encrytpassword', '$telephone', '$token')";
      $datainsertqueryexe = mysqli_query($con, $datainsertquery);

      if ($datainsertqueryexe){
        session_start();
        $_SESSION['email']=$email;
        header("Location: home.php");
      }
    }

    
    //database connection for LOG IN FORM VALIDATION called from 'logIn.php'
    if(isset($_POST['login'])){
      $email= $password= "";
      $email= mysqli_real_escape_string($con, $_POST['email']);
      $password= mysqli_real_escape_string($con, $_POST['password']);
      $encrypt= md5(md5($password));
      
      //email existence
      $emailquery = "SELECT * FROM registeredusers WHERE email = '$email' ";
      $emailqueryexe = mysqli_query($con, $emailquery);
      $count = mysqli_num_rows($emailqueryexe);

      if($count == 0){
        ?> <script type='text/javascript'> alert(" Email do not exist. Try Signing Up.");</script> <?php
      }
      else{
        $getsuserloc = mysqli_fetch_assoc($emailqueryexe);
        $getscode = $getsuserloc['scode'];
        //password validation
        if($encrypt === $getscode){
          session_start();
          $_SESSION['email']= $email;

          //searching for plan in database Plan Details
          $count = 0;
          $emailquery = "SELECT * FROM plandetails WHERE email = '$email' ";
          $emailqueryexe = mysqli_query($con, $emailquery);
          $count = mysqli_num_rows($emailqueryexe);

          //redirecting conditons
          if( $count == 0 )
            header("Location: home.php");
          else
            header("Location: homePlan.php");
        }
        else {
          ?><script type='text/javascript'> alert('Incorrect Password !');</script> <?php
        }
      }     
    }


    //database connection for sending reset password mail called from 'recoverMailLink.php'
    if(isset($_POST['sendMail'])){
      $rcv_email= $subject = $body = $sender_email = $_SESSION['msg'] = $_SESSION['alert']= "";
      $rcv_email= mysqli_real_escape_string($con, $_POST['email']);

      //email existence
      $emailquery = "SELECT * FROM registeredusers WHERE email = '$rcv_email' ";
      $emailqueryexe = mysqli_query($con, $emailquery);
      $count = mysqli_num_rows($emailqueryexe);

      if($count == 0){
        ?><script type='text/javascript'> alert(" Email do not exist. Try Signing Up.");</script> <?php
      }
      else{
        $getuserloc = mysqli_fetch_assoc($emailqueryexe);
        $username = $getuserloc['user'];
        $token = $getuserloc['token'];
        $subject = "Reset Password";
        $body = "Hi $username,\n Click here to reset your password http://localhost/expense-manager/recoverPassword.php?token=$token . \n \n Do not reply. It is a machine generated mail.";
        $sender_email = "From: yourMailId@gmail.com";

        if(mail($rcv_email, $subject, $body, $sender_email)){
          $_SESSION['alert'] = "alert-success";
          $_SESSION['msg'] = "SUCCESS ! Please check $rcv_email to reset your password.";
        }else{
          $_SESSION['msg'] = "ERROR : Failed to send Reset Password link.";
          $_SESSION['alert'] = "alert-danger";
        }        
      }

    }


    //database connection for sending reset password mail called from 'recoverPassword.php'
    if(isset($_POST['resetPassword'])){
      $newpassword= $cnewpassword= $token = "";
      $token = $_GET['token'];
      $newpassword= mysqli_real_escape_string($con, $_POST['newpassword']);
      $cnewpassword= mysqli_real_escape_string($con, $_POST['confirmnewpassword']);

      if(strlen($newpassword)>=6){
        if( $newpassword === $cnewpassword){
          $encrypt= md5(md5($newpassword));
          $query= " UPDATE registeredusers SET scode='$encrypt' WHERE token='$token' ";
          $queryexe = mysqli_query($con, $query);
          if($queryexe){
            ?><script type='text/javascript'> alert('Password updated succesfully!');</script> <?php
            header("Location: logIn.php");            
          }else{
            ?><script type='text/javascript'> alert('Failed to update your password. Try again!');</script> <?php
          }
        }else{
          ?><script type='text/javascript'> alert('New Password Mis-matched');</script> <?php
        }
      }else{
        ?><script type='text/javascript'> alert('Please enter password of min. 6 digits.');</script> <?php
      }      
    }


    //database connection for HOME PLANS PAGE called from 'homePlan.php'
    function homePlans($email){
      
      $emailquery= "SELECT * FROM plandetails WHERE email = '$email' ";
      $emailqueryexe = mysqli_query($_SESSION['con'], $emailquery);
      $_SESSION['count'] = $count = mysqli_num_rows($emailqueryexe);
      
      //empty arrays for storing fetched data
      $arrayTitle = $arrayBudget = $arrayPeople = $arrayfromdate = $arraytodate = [];

      //fetching data frrom database
      for( $i=0; $i < $count; $i++) {
        $getuserloc = mysqli_fetch_assoc($emailqueryexe);
        $arrayTitle["$i"] = $getuserloc['title'];
        $arrayBudget["$i"] = $getuserloc['initialbudget'];
        $arrayPeople["$i"] = $getuserloc['people'];
        $arrayfromdate["$i"] = $getuserloc['fromdate'];
        $arraytodate["$i"] = $getuserloc['todate'];
      }

      $_SESSION['arraytitle'] = $arrayTitle;
      $_SESSION['arraybudget'] = $arrayBudget;
      $_SESSION['arraypeople'] = $arrayPeople;
      $_SESSION['arrayfromdate'] = $arrayfromdate;
      $_SESSION['arraytodate'] = $arraytodate;

    }


    //database connection for CREATING NEW PLAN called from 'createNewPlan.php'
    if(isset($_POST['createNewPlan'])){

      $email= $budget= $people= "";
      $email= $_SESSION['email'];
      $budget = intval(mysqli_real_escape_string($con, $_POST['initialBudget']));
      $people = intval(mysqli_real_escape_string($con, $_POST['people']));

      if($budget>0 && $people>0){
        $_SESSION['temp-budget']= $budget;
        $_SESSION['temp-people']= $people;
        header('location: planDetailsPage.php');
      }
      else{
        ?><script type='text/javascript'> alert('Invalid inputs !');</script> <?php
      }
    }


    //database connection for PLAN DETAILS called from 'planDetailsPage.php'
    if(isset($_POST['planDetails'])){
      $email= $title= $fromdate= $todate= $budget= $people= "";
      $counter = 0;
      $email = $_SESSION['email'];
      $title = mysqli_real_escape_string($con, $_POST['title']);
      $fromdate = mysqli_real_escape_string($con, $_POST['fromDate']);
      $todate = mysqli_real_escape_string($con, $_POST['toDate']);
      $budget = $_SESSION['temp-budget'];
      $people = $_SESSION['temp-people'];

      $valid_date= "/[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])/";
      if ( preg_match($valid_date, $fromdate) && preg_match($valid_date, $todate) ){
        //inserting data into database
        $datainsertquery = " INSERT INTO plandetails (email, title, fromdate, todate, initialbudget, remaining_amount, people) VALUES ('$email', '$title', '$fromdate', '$todate', '$budget', '$budget', '$people')";
        $datainsertqueryexe = mysqli_query($con, $datainsertquery);
        $counter++;

        //inserting people name
        for($i=1 ; $i <= $_SESSION['temp-people'] ; $i++)
        {
          $peoplename="";
          $peoplename= mysqli_real_escape_string($con, $_POST["peoplename$i"]);
          $datainsertquery = " INSERT INTO people (email, title, peoplename) VALUES ('$email', '$title', '$peoplename')";
          $datainsertqueryexe = mysqli_query($con, $datainsertquery);
          $counter++;
        }
      }
      else{
        ?><script type='text/javascript'> alert('Invalid date format ! Format: yyyy-mm-dd');</script> <?php
      }

      //redirecting to next page
      if( $_SESSION['temp-people']+1 == $counter)
        header('location: homePlan.php');

    }


    //database connection for viewing particular plan from home plan page called from 'homePlan.php'
    if(isset($_GET['viewPlan'])){
      $index = $_GET['viewPlan'];
      $_SESSION['title'] = $selectedPlanTitle = mysqli_real_escape_string($con, $_SESSION['arraytitle'][$index]);
      $email = $_SESSION['email'];
      viewPlanfunc($email, $selectedPlanTitle);
      expenses($email, $selectedPlanTitle);
    }


    //database conectivity of VIEW PLAN called from above if condition
    function viewPlanfunc($email, $title){

      $query1= "SELECT * FROM plandetails WHERE email = '$email' AND title = '$title' ";
      $queryexe = mysqli_query($_SESSION['con'], $query1);
      $getuserloc = mysqli_fetch_assoc($queryexe);

      $_SESSION['title']= $getuserloc['title'];
      $_SESSION['people']= $getuserloc['people'];
      $_SESSION['initialbudget']= $getuserloc['initialbudget'];
      $_SESSION['remaining_amount']= $getuserloc['remaining_amount'];
      $_SESSION['fromdate']= $getuserloc['fromdate'];
      $_SESSION['todate']= $getuserloc['todate'];
    }

    //database connectivity to fetch expenses from table EXPENSES called from above if condition
    function expenses($email, $title){

      //fetching data from expense table
      $emailquery= "SELECT * FROM expenses WHERE email= '$email' AND title = '$title' ";
      $emailqueryexe = mysqli_query($_SESSION['con'], $emailquery);
      $count = mysqli_num_rows($emailqueryexe);

      $_SESSION['row'] = $count;
      $arrayExpenseTitle = $arrayExpenseAmount = $arrayPaidBy = $arrayPaidOn = [];
      if($count > 0){
        $i=0;
          while( $getuserloc = mysqli_fetch_assoc($emailqueryexe)){        
          $arrayExpenseTitle[$i] = $getuserloc['expense'];
          $arrayExpenseAmount[$i] = $getuserloc['paidamt'];
          $arrayPaidBy[$i] = $getuserloc['paidby'];
          $arrayPaidOn[$i] = $getuserloc['paidon'];
          $i++;
        }
        $_SESSION['arrayExpenseTitle'] = $arrayExpenseTitle;
        $_SESSION['arrayExpenseAmount'] = $arrayExpenseAmount;
        $_SESSION['arrayPaidBy'] = $arrayPaidBy;
        $_SESSION['arrayPaidOn'] = $arrayPaidOn;
      }
    }

    
    //database connectivity of people names
    function peopleName($email, $title){

      //fetching data from database table: people
      $emailquery= "SELECT * FROM people WHERE email = '$email' AND title = '$title' ";
      $emailqueryexe = mysqli_query($_SESSION['con'], $emailquery);
      $qtyPeo= 0;
      $arrayPeopleName = [];
      while( $getuserloc = mysqli_fetch_assoc($emailqueryexe) ){
        $arrayPeopleName[$qtyPeo++] = $getuserloc['peoplename'];
      }
      $_SESSION['arrayPeopleName'] = $arrayPeopleName;
      $_SESSION['qtyPeo'] = $qtyPeo;
    }


    //database connectivity of ADD NEW EXPENSE called from 'viewPlan.php'
    if( isset($_POST['addNewExpense'])){

      $email = $title = $expensename = $date = $amountspent = $paidby = "";

      $email = $_SESSION['email'];
      $title = $_SESSION['title'];
      $expensename = mysqli_real_escape_string($con, $_POST['ename']);
      $date = mysqli_real_escape_String($con, $_POST['date']);
      $amountspent = intval(mysqli_real_escape_string($con, $_POST['amount-spent']));
      $paidby = mysqli_real_escape_string($con, $_POST['name']);
      
      //inserting new expenses into EXPENSES table
      $query1= " INSERT INTO expenses (email, title, expense, paidon, paidamt, paidby) VALUES ('$email', '$title', '$expensename', '$date', '$amountspent', '$paidby') ";
      $queryexe1 = mysqli_query($_SESSION['con'], $query1);

      $query = "SELECT * FROM plandetails WHERE email= '$email' AND title= '$title' ";
      $queryexe =  mysqli_query($_SESSION['con'], $query);
      $getuserloc = mysqli_fetch_assoc($queryexe);
      $result = $getuserloc['remaining_amount']- $amountspent;

      $query2 = "UPDATE plandetails SET remaining_amount='$result' WHERE email = '$email' AND title = '$title' ";
      $queryexe2 = mysqli_query($_SESSION['con'], $query2);

      header("Refresh:0");
    }


    //database connectivity for changing password called from 'changePassword.php'
    if( isset($_POST['changePassword'])){

      $email= $newpassword= $newpasswordc= "";
      $email = $_SESSION['email'];
      
      $password= md5(md5(mysqli_real_escape_string($con, $_POST['oldpassword'])));
      $newpassword= mysqli_real_escape_string($con, $_POST['newpassword']);
      $newpasswordc= mysqli_real_escape_string($con, $_POST['confirmnewpassword']);
      

      $query = "SELECT * FROM registeredusers WHERE email = '$email' ";
      $queryexe = mysqli_query($con, $query);
      $getsuserloc = mysqli_fetch_assoc($queryexe);
      $getscode = $getsuserloc['scode'];
      //old password validation
      if(($password === $getscode)){
        if(strlen($newpassword) < 6)
        {
          ?><script type='text/javascript'> alert('Please enter password of min. 6 digits.');</script> <?php
        }
        else{
          $newpassword= md5(md5($newpassword));
          $newpasswordc= md5(md5($newpasswordc));
          if( $newpassword === $newpasswordc ){
            $query= " UPDATE registeredusers SET scode='$newpassword' WHERE email = '$email' ";
            $queryexe = mysqli_query($con, $query);
            ?><script type='text/javascript'> alert('Password changed successfully !');</script> <?php
          }else{
            ?><script type='text/javascript'> alert('New Password Mis-matched');</script> <?php
          }
        }
      }
      else{
        ?><script type='text/javascript'> alert('Incorrect Password !');</script> <?php
      }
    }

?>