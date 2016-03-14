<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HotelQ</title>

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
    if(isset($_SESSION['member_id'])){

    } else {
      //User is not logged in. Redirect the browser to the login index.php page and kill this page.
      header("Location: index.php");
      die();
    }
  ?>

  <!-- Page code goes here -->

  <?php include_once('actions/navbar.php'); ?>

  <!-- padding to put things beneath navbar -->
  <div class="navbar-padding"></div>

  <!-- Services -->
  <!-- The circle icons use Font Awesome's stacked icon classes. For more information, visit http://fontawesome.io/examples/ -->
  <section id="services" class="bg-primary">
      <div class="container">
          <div class="row text-center">
              <div class="col-lg-10 col-lg-offset-1">
                  <div class="navbar-padding"></div>
                  <div class="navbar-padding"></div>
                  <div class="navbar-padding"></div>
                  <h1>Welcome to HotelQ</h1>
                  <hr class="small">
                  <div class="row">
                      <div class="col-md-3 col-sm-6">
                          <div class="service-item">
                              <span class="fa-stack fa-4x">
                              <i class="fa fa-circle fa-stack-2x"></i>
                              <i class="fa fa-search fa-stack-1x text-primary"></i>
                          </span>
                              <h4>
                                  <strong>Search</strong>
                              </h4>
                              <p>Find a unique place to stay for your next vacation.</p>
                              <a href="search.php" class="btn btn-dark">Search Now</a>
                          </div>
                      </div>
                      <div class="col-md-3 col-sm-6">
                          <div class="service-item">
                              <span class="fa-stack fa-4x">
                              <i class="fa fa-circle fa-stack-2x"></i>
                              <i class="fa fa-hotel fa-stack-1x text-primary"></i>
                          </span>
                              <h4>
                                  <strong>My Bookings</strong>
                              </h4>
                              <p>Take a look at the current status of all of your bookings.</p>
                              <a href="bookings.php" class="btn btn-dark">Manage Bookings</a>
                          </div>
                      </div>
                      <div class="col-md-3 col-sm-6">
                          <div class="service-item">
                              <span class="fa-stack fa-4x">
                              <i class="fa fa-circle fa-stack-2x"></i>
                              <i class="fa fa-home fa-stack-1x text-primary"></i>
                          </span>
                              <h4>
                                  <strong>My Properties</strong>
                              </h4>
                              <p>Manange your properties and view current booking requests.</p>
                              <a href="properties.php" class="btn btn-dark">Manage Properties</a>
                          </div>
                      </div>
                      <div class="col-md-3 col-sm-6">
                          <div class="service-item">
                              <span class="fa-stack fa-4x">
                              <i class="fa fa-circle fa-stack-2x"></i>
                              <i class="fa fa-cogs fa-stack-1x text-primary"></i>
                          </span>
                              <h4>
                                  <strong>Settings</strong>
                              </h4>
                              <p>Manage your profile, settings and membership.</p>
                              <a href="settings.php" class="btn btn-dark">Edit Profile</a>
                          </div>
                      </div>
                  </div>
                  <!-- /.row (nested) -->
              </div>
              <!-- /.col-lg-10 -->
          </div>
          <!-- /.row -->
          <div class="navbar-padding"></div>

          <?php
            echo "<div class=\"bottom-home-padding\"></div>";
            include_once ('actions/conn.php');

            // QUERY IF PREMIUM
            // top banner echo'd if not PREMIUM
            /*
            if (premium && admin) {
              // just admin stuff
            }
            elseif (admin && not premium)
              // both
            else { // not admin, premium
              // add premium

            }
            */

            // QUERY IF ADMIN
            // then do an echo of the layout with 5 parts

            // else echo 4 parts


          ?>

      </div>
      <!-- /.container -->
  </section>

  <!-- jQuery -->
  <script src="js/jquery.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>

</body>

</html>
