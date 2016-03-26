<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HotelQ - List Property</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/stylish-portfolio.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Catamaran:600' rel='stylesheet' type='text/css'>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

  <?php
    //Create a user session or resume an existing one
   session_start();
  ?>

  <?php

    if(isset($_POST['commentBtn']) && isset($_SESSION['member_id'])){
     // include database connection
      include_once 'actions/conn.php';
      $booking_id = $_GET['booking_id'];
      $property_id = $_GET['property_id'];

      $comment_text = $_POST['comment_text'];
      $rating = $_POST['rating'];

      $id = array("20000008","20000009","20000010","20000011","20000012","20000013","20000014");

      // generate member_id
      $query = "SELECT * FROM comment";
      $stmt = $con->prepare($query);
      $stmt->execute();
      $result = $stmt->get_result();
      $num = $result->num_rows;;
      $comment_id = $id[$num - 5];

      $query = "INSERT INTO comment VALUES (?,?,?,?,?)";
      $stmt = $con->prepare($query);
      $stmt->bind_param('sssss', $_SESSION['member_id'],$property_id,$comment_text,$comment_id,$rating);
      $stmt->execute();
      header("Location: bookings.php");
      die();
    }
  ?>

  <?php
    if(isset($_SESSION['member_id'])){
      $booking_id = $_GET['booking_id'];
      $property_id = $_GET['property_id'];
    } else {
      //User is not logged in. Redirect the browser to the login index.php page and kill this page.
      header("Location: index.php");
      die();
    }
  ?>

  <?php include_once('actions/navbar.php') ?>
  <div class="navbar-padding"></div>
  <div class="navbar-padding"></div>
  <div class="navbar-padding"></div>
  <div class="navbar-padding"></div>

  <!-- Page code goes here -->
  <section>
    <div class="container">
      <div class="row register">
        <div class="col-lg-10 col-lg-offset-1 text-center">
          <h2><strong>Comment on Property</strong></h2>
          <hr class="small">
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-lg-offset-4 text-center">
          <form name='comment' id='comment' action='comment_booking.php?booking_id=<?php echo $booking_id;?>&property_id=<?php echo $property_id;?>' method='post'>
            <div class="form-group">
                <input type="text" maxlength="140" required class="form-control" name="comment_text" placeholder="Comment">
            </div>

            <div class="form-group">

              Rating: &nbsp;
              <select name="rating">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
            </div>

              <div class="form-group">
                <input class="btn btn-primary btn-lg" type='submit' id='commentBtn' name='commentBtn' value='Submit Comment' />
              </div>
          </form>
        </div>
      </div>
  </section>

  <!-- jQuery -->
  <script src="js/jquery.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>

</body>

</html>
