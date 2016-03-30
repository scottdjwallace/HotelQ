<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HotelQ - Service Reports</title>

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
      include_once 'actions/conn.php';
      $query = "SELECT * FROM booking ORDER BY member_id";
      $stmt = $con->prepare($query);
      $stmt->execute();
      $result = $stmt->get_result();

      $query2 = "SELECT * FROM booking left join (SELECT property_id, AVG(rating) FROM comment GROUP BY property_id) t1 on booking.property_id = t1.property_id";
      $stmt2 = $con->prepare($query2);
      $stmt2->execute();
      $result2 = $stmt2->get_result();

      $query3 = "SELECT * FROM booking left join (SELECT owns.property_id, owns.member_id as owner_id, AVG(rating) FROM comment, owns WHERE comment.property_id = owns.property_id GROUP BY property_id) t1 on booking.property_id = t1.property_id";
      $stmt3 = $con->prepare($query3);
      $stmt3->execute();
      $result3 = $stmt3->get_result();
    } else {
      //User is not logged in. Redirect the browser to the login index.php page and kill this page.
      header("Location: index.php");
      die();
    }
  ?>

  <?php include_once('actions/admin_navbar.php') ?>
  <div class="navbar-padding"></div>
  <div class="navbar-padding"></div>

  <?php
  echo "
  <section id=\"results\">
    <div class=\"container\">
      <div class=\"row register\">
        <div class=\"col-lg-10 col-lg-offset-1 text-center\">
          <h2><strong>Member Booking Activity</strong></h2>
          <hr class=\"small\"></hr>
        </div>
      </div>
      <div class=\"row text-center\">
          <div class=\"col-lg-1\"></div>
          <div class=\"col-lg-2\">
            <h4>Member ID</h4>
          </div>
          <div class=\"col-lg-2\">
            <h4>Property ID</h4>
          </div>
          <div class=\"col-lg-2\">
            <h4>Booking ID</h4>
          </div>
          <div class=\"col-lg-2\">
            <h4>Period</h4>
          </div>
          <div class=\"col-lg-2\">
            <h4>Status</h4>
          </div>
          <div class=\"col-lg-1\"></div>
      </div>
      <br>
  ";


  while($row = $result->fetch_assoc()){
    echo "
    <div class=\"row text-center\">
    <div class=\"col-lg-1\"></div>
      <div class=\"col-lg-2\">
    ";
          echo $row['member_id'];
    echo "
    </div>
    <div class=\"col-lg-2\">
    ";
          echo $row['property_id'];
    echo "
    </div>
    <div class=\"col-lg-2\">
    ";
        //address
        echo $row['booking_id'];
    echo "
    </div>
    <div class=\"col-lg-2\">
    ";
        echo $row['period'];
    echo "
    </div>
    <div class=\"col-lg-2\">
    ";
        echo $row['status'];

    echo "
    </div>
    <div class=\"col-lg-1\"></div>
    </div>
    <hr>
    ";
  }

  echo "
    </div>
    </section>
  ";
  ?>


  <?php
  echo "
  <section id=\"results\">
    <div class=\"container\">
      <div class=\"row register\">
        <div class=\"col-lg-10 col-lg-offset-1 text-center\">
          <h2><strong>Bookings vs. Average Rating Per Property</strong></h2>
          <hr class=\"small\"></hr>
        </div>
      </div>
      <div class=\"row text-center\">
          <div class=\"col-lg-2\">
            <h4>Member ID</h4>
          </div>
          <div class=\"col-lg-2\">
            <h4>Property ID</h4>
          </div>
          <div class=\"col-lg-2\">
            <h4>Booking ID</h4>
          </div>
          <div class=\"col-lg-2\">
            <h4>Period</h4>
          </div>
          <div class=\"col-lg-2\">
            <h4>Status</h4>
          </div>
          <div class=\"col-lg-2\">
            <h4>Average Rating</h4>
          </div>
      </div>
      <br>
  ";


  while($row2 = $result2->fetch_assoc()){
    echo "
    <div class=\"row text-center\">
      <div class=\"col-lg-2\">
    ";
          echo $row2['member_id'];
    echo "
    </div>
    <div class=\"col-lg-2\">
    ";
          echo $row2['property_id'];
    echo "
    </div>
    <div class=\"col-lg-2\">
    ";
        //address
        echo $row2['booking_id'];
    echo "
    </div>
    <div class=\"col-lg-2\">
    ";
        echo $row2['period'];
    echo "
    </div>
    <div class=\"col-lg-2\">
    ";
        echo $row2['status'];
    echo "
    </div>
    <div class=\"col-lg-2\">
    ";
        echo $row2['AVG(rating)'];
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
  ?>


  <?php
  echo "
  <section id=\"results\">
    <div class=\"container\">
      <div class=\"row register\">
        <div class=\"col-lg-10 col-lg-offset-1 text-center\">
          <h2><strong>Bookings vs. Average Rating Per Supplier</strong></h2>
          <hr class=\"small\"></hr>
        </div>
      </div>
      <div class=\"row text-center\">
          <div class=\"col-lg-2\">
            <h4>Member ID</h4>
          </div>
          <div class=\"col-lg-2\">
            <h4>Property ID</h4>
          </div>
          <div class=\"col-lg-2\">
            <h4>Booking ID</h4>
          </div>
          <div class=\"col-lg-2\">
            <h4>Period</h4>
          </div>
          <div class=\"col-lg-2\">
            <h4>Status</h4>
          </div>
          <div class=\"col-lg-1\">
            <h4>Owner ID</h4>
          </div>
          <div class=\"col-lg-1\">
            <h4>Average Rating</h4>
          </div>
      </div>
      <br>
  ";


  while($row3 = $result3->fetch_assoc()){
    echo "
    <div class=\"row text-center\">
      <div class=\"col-lg-2\">
    ";
          echo $row3['member_id'];
    echo "
    </div>
    <div class=\"col-lg-2\">
    ";
          echo $row3['property_id'];
    echo "
    </div>
    <div class=\"col-lg-2\">
    ";
        //address
        echo $row3['booking_id'];
    echo "
    </div>
    <div class=\"col-lg-2\">
    ";
        echo $row3['period'];
    echo "
    </div>
    <div class=\"col-lg-2\">
    ";
        echo $row3['status'];
    echo "
    </div>
    <div class=\"col-lg-1\">
    ";
        echo $row3['owner_id'];
    echo "
    </div>
    <div class=\"col-lg-1\">
    ";
        echo $row3['AVG(rating)'];
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
  ?>


  <!-- jQuery -->
  <script src="js/jquery.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>

</body>

</html>
