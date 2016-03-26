<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HotelQ - My Bookings</title>

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

  <?php include_once('actions/navbar.php') ?>
  <div class="navbar-padding"></div>
  <div class="navbar-padding"></div>
  <div class="navbar-padding"></div>

  <?php
    if(isset($_SESSION['member_id'])){

      include_once('actions/conn.php');

      // SELECT query
      $query = "SELECT * FROM booking NATURAL JOIN property WHERE member_id=?";
      $stmt = $con->prepare($query);
      $stmt->bind_Param("s", $_SESSION['member_id']);
      $stmt->execute();
      $result = $stmt->get_result();
      //$myrow = $result->fetch_assoc();

      $num = $result->num_rows;;

		  if($num>0){
        // period, status, property details, comment, rate,cancel
        echo "
        <section id=\"bookings\">
          <div class=\"container\">
            <div class=\"row register\">
              <div class=\"col-lg-10 col-lg-offset-1 text-center\">
                <h2><strong>My Bookings</strong></h2>
                <hr class=\"small\"></hr>
              </div>
            </div>
            <div class=\"row text-center\">
                <div class=\"col-lg-4\">
                  <h4>Property Details</h4>
                </div>
                <div class=\"col-lg-2\">
                  <h4>Status</h4>
                </div>
                <div class=\"col-lg-2\">
                  <h4>Booking Period</h4>
                </div>
                <div class=\"col-lg-2\">
                  <h4>Comment & Rate</h4>
                </div>
                <div class=\"col-lg-2\">
                  <h4>Cancel Booking</h4>
                </div>
              </div>
            <br>
        ";

        while($row = $result->fetch_assoc()){
          echo "
          <div class=\"row text-center\">
            <div class=\"col-lg-4\">
          ";
                // Property details
                echo $row['address'] . ", " . $row['city'] . ", " . $row['state'];

          echo "
          </div>
          <div class=\"col-lg-2\">
          ";
                // status
                echo $row['status'];

          echo "
          </div>
          <div class=\"col-lg-2\">
          ";
                //period
                echo $row['period'];

          echo "
          </div>
          <div class=\"col-lg-2\">
          ";
                //comment & rate, need property id too
                echo "<a href=\"comment_booking.php?booking_id=";
                echo $row['booking_id'];
                echo "&property_id=";
                echo $row['property_id'];
                echo "\">Comment</a>";

          echo "
          </div>
          <div class=\"col-lg-2\">
          ";
                //cancel
                echo "<a href=\"actions/cancel_booking.php?booking_id=";
                echo $row['booking_id'];
                echo "\">Cancel</a>";

          echo "
          </div>
          </div>
          <hr>
          ";
        }

        echo "
        </div>
        </section>
        ";

      }
      else {
        echo "
        <section id=\"bookings\">
          <div class=\"container\">
            <div class=\"row register\">
              <div class=\"col-lg-10 col-lg-offset-1 text-center\">
                <h2><strong>You currently have no bookings.</strong></h2>
                <hr class=\"small\"></hr>
              </div>
            </div>
            <div class=\"row text-center\">
              <div class=\"col-lg-10 col-lg-offset-1 text-center\">
                <a href=\"search.php\">Look for bookings now</a>
              </div>
            </div>
            <br>
          </div>
        </section>
        ";
      }


    } else {
      //User is not logged in. Redirect the browser to the login index.php page and kill this page.
      header("Location: index.php");
      die();
    }
  ?>

  <!-- jQuery -->
  <script src="js/jquery.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>

</body>

</html>
