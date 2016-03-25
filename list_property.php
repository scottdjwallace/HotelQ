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
    if(isset($_SESSION['member_id'])){
      // include database connection
      // include_once 'config/connection.php';
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
          <h2><strong>List a Property</strong></h2>
          <p><i>All fields required.</i></p>
          <hr class="small">
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-lg-offset-4 text-center">
          <form name='listProperty' id='listProperty' action='actions/list_new_property.php' method='post'>


              <div class="form-group">
                Select a Type: &nbsp; &nbsp;
                <select name="type">
                  <option value="oneBed">1 Bedroom Apt</option>
                  <option value="twoBed">2 Bedroom Apt</option>
                  <option value="threeBed">3 Bedroom Apt</option>
                  <option value="fourBed">4 Bedroom Apt</option>
                  <option value="studio">Studio</option>
                </select>
              </div>

              <div class="form-group">
                  <input type="int" maxlength="10" required class="form-control" name="price" placeholder="Price per Week">
              </div>
              <div class="form-group">
                  <input type="text" maxlength="25" required class="form-control" name="address" placeholder="Address">
              </div>
              <div class="form-group">
                  <input type="text" maxlength="25" required class="form-control" name="city" placeholder="City" value="Seattle">
              </div>
              <div class="form-group">
                  <input type="text" length="2" required class="form-control" name="state" placeholder="State/Province (Ex. ON)" value="WA">
              </div>
              <div class="form-group">
                  <input type="text" maxlength="6" required class="form-control" name="area_code" placeholder="Area Code (Ex. H0H0H0)">
              </div>
              <div class="form-group">
                District: &nbsp; &nbsp;
                <select name="district">
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
              <hr class="small">
              <div class="form-group">
                <input class="btn btn-default btn-lg" type='submit' id='listPropertyBtn' name='listPropertyBtn' value='List Property' />
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
