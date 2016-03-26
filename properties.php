<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HotelQ - My Properties</title>

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
      $query = "SELECT * FROM owns NATURAL JOIN property WHERE member_id=?";
      $stmt = $con->prepare($query);
      $stmt->bind_Param("s", $_SESSION['member_id']);
      $stmt->execute();
      $result = $stmt->get_result();
      //$myrow = $result->fetch_assoc();

      $num = $result->num_rows;;

		  if($num>0){
        // type, price, address-city-state-areacode, district, view requests, update, delete
        echo "
        <section id=\"properties\">
          <div class=\"container\">
            <div class=\"row register\">
              <div class=\"col-lg-10 col-lg-offset-1 text-center\">
                <h2><strong>My Properties</strong></h2>
                <hr class=\"small\"></hr>
              </div>
            </div>
            <div class=\"row text-center\">
                <div class=\"col-lg-2\">
                  <h4>Type</h4>
                </div>
                <div class=\"col-lg-1\">
                  <h4>Price</h4>
                </div>
                <div class=\"col-lg-3\">
                  <h4>Address</h4>
                </div>
                <div class=\"col-lg-2\">
                  <h4>Booking Requests</h4>
                </div>
                <div class=\"col-lg-2\">
                  <h4>Update Property</h4>
                </div>
                <div class=\"col-lg-2\">
                  <h4>Delete Property</h4>
                </div>
              </div>
            <br>
        ";

        while($row = $result->fetch_assoc()){
          echo "
          <div class=\"row text-center\">
            <div class=\"col-lg-2\">
          ";
                // type
                echo $row['type'];
          echo "
          </div>
          <div class=\"col-lg-1\">
          ";
                // status
                echo $row['price'];
          echo "
          </div>
          <div class=\"col-lg-3\">
          ";
                //address
                echo $row['address'] . ", " . $row['city'] . ", " . $row['state'] . ", " . $row['area_code'];
          echo "
          </div>
          <div class=\"col-lg-2\">
          ";
                echo "<a href=\"view_requests.php?property_id=";
                echo $row['property_id'];
                echo "\">View Requests</a>";
          echo "
          </div>
          <div class=\"col-lg-2\">
          ";
                //update
                echo "<a href=\"update_property.php?property_id=";
                echo $row['property_id'];
                echo "\">Update</a>";
          echo "
          </div>
          <div class=\"col-lg-2\">
          ";
                echo "<a href=\"actions/delete_property.php?property_id=";
                echo $row['property_id'];
                echo "\">Delete</a>";
          echo "
          </div>
          </div>
          <hr>
          ";
        }

        echo "
        <div class=\"row register\">
          <div class=\"col-lg-10 col-lg-offset-1 text-center\">
            <a  href=\"list_property.php\" ><button type=\"button\" class=\"btn btn-primary btn-lg\">List Another Property</button></a>
          </div>
        </div>
        </div>
        </section>
        ";

      }
      else {
        echo "
        <section id=\"properties\">
          <div class=\"container\">
            <div class=\"row register\">
              <div class=\"col-lg-10 col-lg-offset-1 text-center\">
                <h2><strong>You currently have no properties listed.</strong></h2>
                <hr class=\"small\"></hr>
              </div>
            </div>
            <div class=\"row text-center\">
              <div class=\"col-lg-10 col-lg-offset-1 text-center\">
                <a href=\"list_property.php\">List a property now</a>
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
