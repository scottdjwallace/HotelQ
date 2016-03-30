<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HotelQ - View Property</title>

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

  <?php include_once('actions/navbar.php') ?>
  <div class="navbar-padding"></div>

  <?php
    //Create a user session or resume an existing one
   session_start();
  ?>

  <?php
    if(isset($_SESSION['member_id'])){
      include_once 'actions/conn.php';
      $property_id = $_GET['property_id'];

      // property details
      $query = "SELECT * FROM property NATURAL JOIN district WHERE property_id=?";
      $stmt = $con->prepare($query);
      $stmt->bind_Param("s", $property_id);
      $stmt->execute();
      $result = $stmt->get_result();
      $property_row = $result->fetch_assoc();

    } else {
      //User is not logged in. Redirect the browser to the login index.php page and kill this page.
      header("Location: index.php");
      die();
    }
  ?>

<?php $yourAddress = $property_row['address'] . ", " . $property_row['city'] . ", " . $property_row['state'] . ", " . $property_row['area_code']; ?>

<!-- Map -->
<?php $yourAddress = $property_row['address'] . ", " . $property_row['city'] . ", " . $property_row['state'] . ", " . $property_row['area_code']; ?>
<section id="contact" class="map">
  <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA_2IJdY1wHgF1UD1ei3WnyibqNcinOG9A&q=<?php echo $yourAddress; ?>"></iframe>
    <br />
    <small>
        <a href="https://www.google.com/maps/embed/v1/place?key=AIzaSyA_2IJdY1wHgF1UD1ei3WnyibqNcinOG9A&q=<?php echo $yourAddress; ?>"></a>
    </small>
  </iframe>
</section>

  <section>
    <div class="container">
      <div class="row register">
        <div class="col-lg-10 col-lg-offset-1 text-center">
          <h2><strong><?php echo $yourAddress; ?></strong>
          </h2>
          <hr class="small"></hr>
        </div>
      </div>
      <!-- property info - district, type, features, price -->
      <div class="row register">
        <div class="col-lg-10 col-lg-offset-1 text-center">
          <div class="row">
            <div class="col-lg-2">
              <h3>District</h3>
            </div>
            <div class="col-lg-2">
              <h3>Type</h3>
            </div>
            <div class="col-lg-3">
              <h3>Features</h3>
            </div>
            <div class="col-lg-3">
              <h3>Point of Interests</h3>
            </div>
            <div class="col-lg-2">
              <h3>Price</h3>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-lg-2">
              <p><?php echo $property_row['district_name']; ?></p>
            </div>
            <div class="col-lg-2">
              <p><?php echo $property_row['type']; ?></p>
            </div>
            <div class="col-lg-3">
              <p><?php
              //features
              include_once('actions/conn.php');
              $query = "SELECT * FROM has_feature NATURAL JOIN feature WHERE property_id=?";
              $stmt = $con->prepare($query);
              $stmt->bind_Param("s", $property_row['property_id']);
              $stmt->execute();
              $result2 = $stmt->get_result();
              $str = "";
              while($r = $result2->fetch_assoc()){
                $str .= $r['feature_name'] . ", ";
              }
              echo $str;
              ?></p>
            </div>
            <div class="col-lg-3">
              <p><?php
              //features
              include_once('actions/conn.php');
              $query = "SELECT * FROM contains NATURAL JOIN point_of_interest WHERE district_id=?";
              $stmt = $con->prepare($query);
              $stmt->bind_Param("s", $property_row['district_id']);
              $stmt->execute();
              $result2 = $stmt->get_result();
              $str = "";
              while($r = $result2->fetch_assoc()){
                $str .= $r['poi_name'] . ", ";
              }
              echo $str;
              ?></p>
            </div>
            <div class="col-lg-2">
              <p><?php echo $property_row['price']; ?></p>
            </div>
          </div>
          <hr>
        </div>
      </div>

      <!-- comments & ratings -->
      <div class="row register">
        <div class="col-lg-10 col-lg-offset-1 text-center">
          <?php
              include_once('actions/conn.php');

              // SELECT query
              $query = "SELECT * FROM comment WHERE property_id=? AND comment_id not in (SELECT reply_id FROM reply)";
              $stmt = $con->prepare($query);
              $stmt->bind_Param("s", $property_row['property_id']);
              $stmt->execute();
              $result = $stmt->get_result();
              //$myrow = $result->fetch_assoc();

              $num = $result->num_rows;;

              if($num>0){
                echo "
                        <h3><strong>Comments & Ratings</strong></h3>
                        <hr class=\"small\"></hr>
                      </div>
                    </div>
                    <br>
                ";

                while($row2 = $result->fetch_assoc()){
                  echo "
                  <div class=\"row text-center\">
                  <div class=\"col-lg-2\"></div>
                    <div class=\"col-lg-6\">
                  ";
                        // type
                        echo $row2['comment_text'];
                  echo "
                  </div>
                  <div class=\"col-lg-2\">
                  ";
                        // status
                        echo $row2['rating'];
                  echo "
                  </div>
                  <div class=\"col-lg-2\"></div>
                  </div>
                  <br>
                  ";
                }
              }
              else {
                echo "
                    <h2><strong>No Comments to display</strong></h2>
                    </div>
                    </div>

                ";
              }
          ?>
          <hr>
        </div>
      </div>

      <!-- availability book now, button to form -->
      <div class="row">
      <form name='submit' id='submit' action='actions/submit_booking.php?property_id=<?php echo $property_row['property_id']; ?>' method='post'>
        <div class="col-lg-4 col-lg-offset-4 text-center">
          <div class="form-group">
            Availability: &nbsp;
            <select name="availability">
              <?php
              $dates = array(" 2016-4-4"," 2016-4-11"," 2016-4-18"," 2016-4-25"," 2016-5-2"," 2016-5-9"," 2016-5-16"," 2016-5-23"," 2016-5-30");
              $query = "SELECT * FROM booking WHERE property_id=? AND status=\"Booked\"";
              $stmt = $con->prepare($query);
              $stmt->bind_Param('s', $property_row['property_id']);
              $stmt->execute();
              $result3 = $stmt->get_result();
              $booked_array = array();
              while($dr = $result3->fetch_assoc()){
                array_push($booked_array,$dr['period']);
              }
              foreach($dates as $d){
                if (in_array($d, $booked_array)) {
                }
                else {
                  echo "<option value=\"" . $d . "\">" . $d . "</option>";
                }
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <input class="btn btn-primary btn-lg" type='submit' id='submitBtn' name='submitBtn' value='Submit Booking Request' />
          </div>
          <br><br><br>
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
