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

  <?php include_once('actions/navbar.php') ?>
  <div class="navbar-padding"></div>
  <div class="navbar-padding"></div>

  <?php
    //Create a user session or resume an existing one
   session_start();
  ?>

  <?php
    if(isset($_SESSION['member_id'])){
      include_once 'actions/conn.php';
      $property_id = $_GET['property_id'];
      $query = "SELECT * FROM property WHERE property_id=?";
      $stmt = $con->prepare($query);
      $stmt->bind_Param("s", $property_id);
      $stmt->execute();
      $result = $stmt->get_result();
      $row = $result->fetch_assoc();

    } else {
      //User is not logged in. Redirect the browser to the login index.php page and kill this page.
      header("Location: index.php");
      die();
    }
  ?>

  <section>
    <div class="container">
      <div class="row register">
        <div class="col-lg-10 col-lg-offset-1 text-center">
          <h2><strong>Update Property</strong>
          </h2>
          <hr class="small"></hr>
        </div>
      </div>
    <div class="row">
      <div class="col-lg-4 col-lg-offset-4 text-center">
        <form name='updateProperty' id='updateProperty' action='actions/update_property_details.php?property_id=<?php echo $row['property_id'];?>' method='post'>


            <div class="form-group">
              Select a Type: &nbsp; &nbsp;
              <select name="type">
                <option value="oneBed" <?php if ($row['type'] == '1 Bedroom Apt') echo ' selected="selected"'; ?>>1 Bedroom Apt</option>
                <option value="twoBed" <?php if ($row['type'] == '2 Bedroom Apt') echo ' selected="selected"'; ?>>2 Bedroom Apt</option>
                <option value="threeBed" <?php if ($row['type'] == '3 Bedroom Apt') echo ' selected="selected"'; ?>>3 Bedroom Apt</option>
                <option value="fourBed" <?php if ($row['type'] == '4 Bedroom Apt') echo ' selected="selected"'; ?>>4 Bedroom Apt</option>
                <option value="studio" <?php if ($row['type'] == 'Studio') echo ' selected="selected"'; ?>>Studio</option>
              </select>
            </div>

            <div class="form-group">
                <input type="int" maxlength="10" required class="form-control" name="price" placeholder="Price per Week" value="<?php echo $row['price']; ?>">
            </div>
            <div class="form-group">
                <input type="text" maxlength="25" required class="form-control" name="address" placeholder="Address" value="<?php echo $row['address']; ?>">
            </div>
            <div class="form-group">
                <input type="text" maxlength="25" required class="form-control" name="city" placeholder="City" value="<?php echo $row['city']; ?>">
            </div>
            <div class="form-group">
                <input type="text" length="2" required class="form-control" name="state" placeholder="State/Province (Ex. ON)" value="<?php echo $row['state']; ?>">
            </div>
            <div class="form-group">
                <input type="text" maxlength="6" required class="form-control" name="area_code" placeholder="Area Code (Ex. H0H0H0)" value="<?php echo $row['area_code']; ?>">
            </div>
            <div class="form-group">
              District: &nbsp; &nbsp;
              <select name="district">
                <option value="001" <?php if ($row['district_id'] == '001') echo ' selected="selected"'; ?>>Fremont</option>
                <option value="002" <?php if ($row['district_id'] == '002') echo ' selected="selected"'; ?>>Wallingford</option>
                <option value="003" <?php if ($row['district_id'] == '003') echo ' selected="selected"'; ?>>Ballard</option>
                <option value="004" <?php if ($row['district_id'] == '004') echo ' selected="selected"'; ?>>Queen Anne</option>
                <option value="005" <?php if ($row['district_id'] == '005') echo ' selected="selected"'; ?>>Lower Queen Anne</option>
                <option value="006" <?php if ($row['district_id'] == '006') echo ' selected="selected"'; ?>>Westlake</option>
                <option value="007" <?php if ($row['district_id'] == '007') echo ' selected="selected"'; ?>>South Lake Union</option>
                <option value="008" <?php if ($row['district_id'] == '008') echo ' selected="selected"'; ?>>Capitol Hill</option>
                <option value="009" <?php if ($row['district_id'] == '009') echo ' selected="selected"'; ?>>Pike Place Market</option>
                <option value="010" <?php if ($row['district_id'] == '010') echo ' selected="selected"'; ?>>Downtown</option>
                <option value="011" <?php if ($row['district_id'] == '011') echo ' selected="selected"'; ?>>Pioneer Square</option>
              </select>
            </div>
            <hr class="small">
            <div class="form-group">
              <input class="btn btn-default btn-lg" type='submit' id='updatePropertyBtn' name='updatePropertyBtn' value='Update Property' />
            </div>
        </form>
      </div>
    </div>
  </div>
</section>

  <!-- jQuery -->
  <script src="js/jquery.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>

</body>

</html>
