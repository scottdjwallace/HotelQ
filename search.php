<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HotelQ - Search</title>

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

    <?php

      if(isset($_POST['searchBtn']) && isset($_SESSION['member_id'])){
        include_once 'actions/conn.php';
        $type = $_POST['type'];
        $district_id = $_POST['district'];
        $price_min =  $_POST['price_min'];
        $price_max = $_POST['price_max'];
        // get checkboxes
        $shared = $_POST['shared'];
        $private = $_POST['private'];
        $close_to_subway = $_POST['close'];
        $pool = $_POST['pool'];
        $full_kitchen = $_POST['full'];
        $laundry = $_POST['laundry'];
        $smoke_free = $_POST['smoke'];
        $scent_free = $_POST['scent'];
        $balcony = $_POST['balcony'];
        $gym = $_POST['gym'];
        $office = $_POST['office'];
        $dishwasher = $_POST['dishwasher'];
        $internet = $_POST['internet'];
        $jacuzzi = $_POST['jacuzzi'];
        $checkboxes = array();
        if ($shared!=""){ array_push($checkboxes, $shared); }
        if ($private!=""){ array_push($checkboxes, $private); }
        if ($close_to_subway!=""){ array_push($checkboxes, $close_to_subway); }
        if ($pool!=""){ array_push($checkboxes, $pool); }
        if ($full_kitchen!=""){ array_push($checkboxes, $full_kitchen); }
        if ($laundry!=""){ array_push($checkboxes, $laundry); }
        if ($smoke_free!=""){ array_push($checkboxes, $smoke_free); }
        if ($scent_free!=""){ array_push($checkboxes, $scent_free); }
        if ($balcony!=""){ array_push($checkboxes, $balcony); }
        if ($gym!=""){ array_push($checkboxes, $gym); }
        if ($office!=""){ array_push($checkboxes, $office); }
        if ($dishwasher!=""){ array_push($checkboxes, $dishwasher); }
        if ($internet!=""){ array_push($checkboxes, $internet); }
        if ($jacuzzi!=""){ array_push($checkboxes, $jacuzzi); }

        $cond = array();
        if ($type!="any"){
          $query1 = "type=\"" . $type . "\"";
          array_push($cond, $query1);
        }
        if ($district_id!="any"){
          $query1 = "district_id=\"" . $district_id . "\"";
          array_push($cond, $query1);
        }
        if ($price_min!=""){
          $query1 = $price_min . "< price";
          array_push($cond, $query1);
        }
        if ($price_max!=""){
          $query1 = $price_max . "> price";
          array_push($cond, $query1);
        }

        $query = "SELECT * FROM property NATURAL JOIN district";

        // subquery for all the checkboxes
        if (count($checkboxes)>0){
          $subquery = "SELECT property_id FROM has_feature NATURAL JOIN feature WHERE feature_name=\"" . $checkboxes[0] . "\"";
          for ($x = 1; $x < count($checkboxes); $x++) {
              $subquery .= " AND property_id in (";
              $subquery .= "SELECT property_id FROM has_feature NATURAL JOIN feature WHERE feature_name=\"" . $checkboxes[$x] . "\"";
          }
          for ($x = 0; $x < count($checkboxes) - 1; $x++) {
              $subquery .= ")";
          }
          $query .= " WHERE ";
          for ($x = 0; $x < count($cond); $x++) {
              $query .= $cond[$x]. " AND ";
          }
          $query .= "property_id in (" .  $subquery . ")";
        }
        else {
          if (count($cond)>0) {
            $query .= " WHERE ";
            for ($x = 0; $x < count($cond) - 1; $x++) {
                $query .= $cond[$x] . " AND ";
            }
            $query .= $cond[count($cond)-1];
          }
        }

        $stmt = $con->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

      }
      elseif(isset($_SESSION['member_id'])){
        // show all properties
        include_once 'actions/conn.php';
        $query = "SELECT * FROM property NATURAL JOIN district";
        $stmt = $con->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
      } else {
        //User is not logged in. Redirect the browser to the login index.php page and kill this page.
        header("Location: index.php");
        die();
      }
    ?>

    <!-- search form -->
    <section id="search_form">
      <div class="container">
        <div class="row register">
          <div class="col-lg-10 col-lg-offset-1 text-center">
            <h2><strong>Search for Properties</strong></h2>
            <hr class="small"></hr>
          </div>
        </div>
        <form name='search' id='search' action='search.php' method='post'>
        <div class="row">
          <div class="col-lg-8 col-lg-offset-2 text-center">
              <!-- searchable by district, type, features, and price. -->
              <div class="form-group">
                Select a Type: &nbsp; &nbsp;
                <select name="type">
                  <option value="any">Any</option>
                  <option value="1 Bedroom Apt">1 Bedroom Apt</option>
                  <option value="2 Bedroom Apt">2 Bedroom Apt</option>
                  <option value="3 Bedroom Apt">3 Bedroom Apt</option>
                  <option value="4 Bedroom Apt">4 Bedroom Apt</option>
                  <option value="Studio">Studio</option>
                </select>
                &nbsp; &nbsp; &nbsp; &nbsp; District: &nbsp; &nbsp;
                <select name="district">
                  <option value="any">Any</option>
                  <option value="001">Fremont</option>
                  <option value="002">Wallingford</option>
                  <option value="003">Ballard</option>
                  <option value="004">Queen Anne</option>
                  <option value="005">Lower Queen Anne</option>
                  <option value="006">Westlake</option>
                  <option value="007">South Lake Union</option>
                  <option value="008">Capitol Hill</option>
                  <option value="009">Pike Place Market</option>
                  <option value="010">Downtown</option>
                  <option value="011">Pioneer Square</option>
                </select>
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-2 text-center">
              <div class="form-group">
                  <input type="int" maxlength="10" required class="form-control" name="price_min" placeholder="Price Min.">
              </div>
            </div>
            <div class="col-lg-2 text-center">
              <div class="form-group">
                  <input type="int" maxlength="10" required class="form-control" name="price_max" placeholder="Price Max">
              </div>
            </div>
            <div class="col-lg-4"></div>
          </div>
          <br>
          <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-2">
              <div class="form-group checkbox">
                <label><input type="hidden" name="shared" id="shared" value=""><input type="checkbox" name="shared" id="shared" value="Shared Bathroom">Shared Bathroom</label>
              </div>
              <div class="form-group checkbox">
                <label><input type="hidden" name="private" id="private" value=""><input type="checkbox" name="private" id="private" value="Private Bathroom">Private Bathroom</label>
              </div>
              <div class="form-group checkbox">
                <label><input type="hidden" name="close" id="close" value=""><input type="checkbox" name="close" id="close" value="Close to Subway">Close to Subway</label>
              </div>
              <div class="form-group checkbox">
                <label><input type="hidden" name="pool" id="pool" value=""><input type="checkbox" name="pool" id="pool" value="Pool">Pool</label>
              </div>
            </div>
            <div class="col-lg-2">
              <div class="form-group checkbox">
                <label><input type="hidden" name="full" id="full" value=""><input type="checkbox" name="full" id="full" value="Full Kitchen">Full Kitchen</label>
              </div>
              <div class="form-group checkbox">
                <label><input type="hidden" name="laundry" id="laundry" value=""><input type="checkbox" name="laundry" id="laundry" value="Laundry">Laundry</label>
              </div>
              <div class="form-group checkbox">
                <label><input type="hidden" name="smoke" id="smoke" value=""><input type="checkbox" name="smoke" id="smoke" value="Smoke Free">Smoke Free</label>
              </div>
              <div class="form-group checkbox">
                <label><input type="hidden" name="scent" id="scent" value=""><input type="checkbox"  name="scent" id="scent" value="Scent Free">Scent Free</label>
              </div>
            </div>
            <div class="col-lg-2">
              <div class="form-group checkbox">
                <label><input type="hidden" name="balcony" id="balcony" value=""><input type="checkbox" name="balcony" id="balcony" value="Balcony">Balcony</label>
              </div>
              <div class="form-group checkbox">
                <label><input type="hidden" name="gym" id="gym" value=""><input type="checkbox" name="gym" id="gym" value="Gym">Gym</label>
              </div>
              <div class="form-group checkbox">
                <label><input type="hidden" name="office" id="office" value=""><input type="checkbox" name="office" id="office" value="Office">Office</label>
              </div>
              <div class="form-group checkbox">
                <label><input type="hidden" name="dishwasher" id="dishwasher" value=""><input type="checkbox" name="dishwasher" id="dishwasher" value="Dishwasher">Dishwasher</label>
              </div>
            </div>
            <div class="col-lg-2">
              <div class="form-group checkbox">
                <label><input type="hidden" name="internet" id="internet" value=""><input type="checkbox" name="internet" id="internet" value="Internet">Internet</label>
              </div>
              <div class="form-group checkbox">
                <label><input type="hidden" name="jacuzzi" id="jacuzzi" value=""><input type="checkbox" name="jacuzzi" id="jacuzzi" value="Jacuzzi">Jacuzzi</label>
              </div>
            </div>
            <div class="col-lg-2"></div>
          </div>
          <br>
          <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <div class="form-group">
                  <input class="btn btn-primary btn-lg" type='submit' id='searchBtn' name='searchBtn' value='Search' />
                </div>
            <hr>
          </div>
        </div>
        </form>
      </div>
    </section>

    <!-- display results -->
    <?php
    echo "
    <section id=\"results\">
      <div class=\"container\">
        <div class=\"row register\">
          <div class=\"col-lg-10 col-lg-offset-1 text-center\">
            <h2><strong>" . $result->num_rows . " Properties Available</strong></h2>
            <hr class=\"small\"></hr>
          </div>
        </div>
        <div class=\"row text-center\">
            <div class=\"col-lg-2\">
              <h4>View Property</h4>
            </div>
            <div class=\"col-lg-2\">
              <h4>Address</h4>
            </div>
            <div class=\"col-lg-2\">
              <h4>District</h4>
            </div>
            <div class=\"col-lg-2\">
              <h4>Type</h4>
            </div>
            <div class=\"col-lg-3\">
              <h4>Features</h4>
            </div>
            <div class=\"col-lg-1\">
              <h4>Price</h4>
            </div>
        </div>
        <br>
    ";


    while($row = $result->fetch_assoc()){
      echo "
      <div class=\"row text-center\">
        <div class=\"col-lg-2\">
      ";
            // view
            echo "<a href=\"view_property.php?property_id=";
            echo $row['property_id'];
            echo "\">View</a>";
      echo "
      </div>
      <div class=\"col-lg-2\">
      ";
            //address
            echo $row['address'] . ", " . $row['city'] . ", " . $row['state'] . ", " . $row['area_code'];
      echo "
      </div>
      <div class=\"col-lg-2\">
      ";
          // district
          echo $row['district_name'];

      echo "
      </div>
      <div class=\"col-lg-2\">
      ";
            echo $row['type'];
      echo "
      </div>
      <div class=\"col-lg-3\">
      ";
      //features
      include_once('actions/conn.php');
      $query = "SELECT * FROM has_feature NATURAL JOIN feature WHERE property_id=?";
      $stmt = $con->prepare($query);
      $stmt->bind_Param("s", $row['property_id']);
      $stmt->execute();
      $result2 = $stmt->get_result();
      $str = "";
      while($r = $result2->fetch_assoc()){
        $str .= $r['feature_name'] . ", ";
      }
      echo $str;
      echo "
      </div>
      <div class=\"col-lg-1\">
      ";
            echo $row['price'];
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
