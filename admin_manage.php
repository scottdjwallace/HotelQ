<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HotelQ - Manage Users & Properties</title>

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
      $query = "SELECT * FROM member NATURAL JOIN faculty";
      $stmt = $con->prepare($query);
      $stmt->execute();
      $result = $stmt->get_result();

      $query2 = "SELECT * FROM property NATURAL JOIN owns";
      $stmt2 = $con->prepare($query2);
      $stmt2->execute();
      $result2 = $stmt2->get_result();
    } else {
      //User is not logged in. Redirect the browser to the login index.php page and kill this page.
      header("Location: index.php");
      die();
    }
  ?>

  <?php include_once('actions/admin_navbar.php') ?>
  <div class="navbar-padding"></div>
  <div class="navbar-padding"></div>
  <!-- display results -->
  <?php
  echo "
  <section id=\"results\">
    <div class=\"container\">
      <div class=\"row register\">
        <div class=\"col-lg-10 col-lg-offset-1 text-center\">
          <h2><strong>" . $result->num_rows . " Members</strong></h2>
          <hr class=\"small\"></hr>
        </div>
      </div>
      <div class=\"row text-center\">
          <div class=\"col-lg-2\">
            <h4>Member ID</h4>
          </div>
          <div class=\"col-lg-2\">
            <h4>Email Address</h4>
          </div>
          <div class=\"col-lg-2\">
            <h4>Address</h4>
          </div>
          <div class=\"col-lg-2\">
            <h4>Faculty</h4>
          </div>
          <div class=\"col-lg-2\">
            <h4>Grad Year</h4>
          </div>
          <div class=\"col-lg-2\">
            <h4>Delete User</h4>
          </div>
      </div>
      <br>
  ";


  while($row = $result->fetch_assoc()){
    echo "
    <div class=\"row text-center\">
      <div class=\"col-lg-2\">
    ";
          echo $row['member_id'];
    echo "
    </div>
    <div class=\"col-lg-2\">
    ";
          echo $row['email'];
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
        echo $row['faculty_name'];
    echo "
    </div>
    <div class=\"col-lg-2\">
    ";
        echo $row['grad_year'];
    echo "
    </div>
    <div class=\"col-lg-2\">
    ";
        echo "<a href=\"actions/admin_delete_member.php?member_id=";
        echo $row['member_id'];
        echo "\">Delete</a>";
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
<section id=\"properties\">
  <div class=\"container\">
    <div class=\"row register\">
      <div class=\"col-lg-10 col-lg-offset-1 text-center\">
        <h2><strong>" . $result2->num_rows . " Properties</strong></h2>
        <hr class=\"small\"></hr>
      </div>
    </div>
    <div class=\"row text-center\">
        <div class=\"col-lg-3\">
          <h4>Owner ID</h4>
        </div>
        <div class=\"col-lg-2\">
          <h4>Type</h4>
        </div>
        <div class=\"col-lg-3\">
          <h4>Address</h4>
        </div>
        <div class=\"col-lg-2\">
          <h4>Price</h4>
        </div>
        <div class=\"col-lg-2\">
          <h4>Delete Property</h4>
        </div>
      </div>
    <br>
";

while($row2 = $result2->fetch_assoc()){
  echo "
  <div class=\"row text-center\">
    <div class=\"col-lg-3\">
  ";
        // type
        echo $row2['member_id'];
  echo "
  </div>
  <div class=\"col-lg-2\">
  ";
        // status
        echo $row2['type'];
  echo "
  </div>
  <div class=\"col-lg-3\">
  ";
        //address
        echo $row2['address'] . ", " . $row2['city'] . ", " . $row2['state'] . ", " . $row2['area_code'];
  echo "
  </div>
  <div class=\"col-lg-2\">
  ";
        echo $row2['price'];
  echo "
  </div>
  <div class=\"col-lg-2\">
  ";
        echo "<a href=\"actions/admin_delete_property.php?property_id=";
        echo $row2['property_id'];
        echo "&member_id=";
        echo $row2['member_id'];
        echo "\">Delete</a>";
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
