<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HotelQ - Account Settings</title>

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
     // include database connection
      include_once 'actions/conn.php';

  	// SELECT query
          $query = "SELECT * FROM member WHERE member_id=?";

          // prepare query for execution
          $stmt = $con->prepare($query);

          // bind the parameters. This is the best way to prevent SQL injection hacks.
          $stmt->bind_Param("s", $_SESSION['member_id']);

          // Execute the query
  		$stmt->execute();

  		// results
  		$result = $stmt->get_result();

  		// Row data
  		$myrow = $result->fetch_assoc();

  } else {
  	//User is not logged in. Redirect the browser to the login index.php page and kill this page.
  	header("Location: index.php");
  	die();
  }

  ?>

  <!-- Edit Account Form Here
  <form name='editAccount' id='editProfile' action='actions/update_member.php' method='post'>
      <table border='0'>
          <tr>
              <td>Username</td>
              <td><input type='text' name='username' id='username' disabled  value="<?php echo $myrow['username']; ?>"  /></td>
          </tr>
          <tr>
              <td>Password</td>
               <td><input type='text' name='password' id='password'  value="<?php echo $myrow['password']; ?>" /></td>
          </tr>
  		<tr>
              <td>Email</td>
              <td><input type='text' name='email' id='email'  value="<?php echo $myrow['email']; ?>" /></td>
          </tr>
          <tr>
              <td></td>
              <td>
                  <input type='submit' name='updateBtn' id='updateBtn' value='Update' />
              </td>
          </tr>
      </table>
  </form>
  -->
  <section>
    <div class="container">
      <div class="row register">
        <div class="col-lg-10 col-lg-offset-1 text-center">
          <h2><strong>Update Profile</strong>
          </h2>
          <hr class="small"></hr>
        </div>
      </div>
    <div class="row">
      <div class="col-lg-4 col-lg-offset-4 text-center">
        <form name='updateMember' id='updateMember' action='actions/update_member.php' method='post'>
            <div class="form-group">
                <input type="text" maxlength="21" class="form-control" name="email" value="<?php echo $myrow['email']; ?>">
            </div>
            <div class="form-group">
                <input type="password" maxlength="50" class="form-control" name="password" value="<?php echo $myrow['password']; ?>">
            </div>

            <div class="form-group">
                <input type="text" length="10" required class="form-control" name="phone_number" value="<?php echo $myrow['phone_number']; ?>">
            </div>
            <div class="form-group">
                <input type="text" length="4" required class="form-control" name="grad_year" value="<?php echo $myrow['grad_year']; ?>">
            </div>
            <div class="form-group">
                <input type="text" maxlength="25" required class="form-control" name="address" value="<?php echo $myrow['address']; ?>">
            </div>
            <div class="form-group">
                <input type="text" maxlength="25" required class="form-control" name="city" value="<?php echo $myrow['city']; ?>">
            </div>
            <div class="form-group">
                <input type="text" length="2" required class="form-control" name="state" value="<?php echo $myrow['state']; ?>">
            </div>
            <div class="form-group">
                <input type="text" maxlength="6" required class="form-control" name="area_code" value="<?php echo $myrow['area_code']; ?>">
            </div>

            <div class="form-group">

              Select an Avatar: &nbsp;
              <select name="avatar">
                <option value="default">Default</option>
                <option value="hockey">Hockey</option>
                <option value="car">Car</option>
                <option value="city">City</option>
                <option value="pizza">Pizza</option>
              </select>

              &nbsp; &nbsp; &nbsp; &nbsp; Degree: &nbsp;
              <select name="degree">
                <option value="bsc">BSc</option>
                <option value="bfa">BFA</option>
                <option value="beng">BEng</option>
                <option value="bphe">BPHE</option>
                <option value="ba">BA</option>
                <option value="bcmp">BCmp</option>
                <option value="bcomm">BComm</option>
                <option value="bscn">BScN</option>
                <option value="bed">BEd</option>
                <option value="msc">MSc</option>
                <option value="meng">MEng</option>
                <option value="phd">PhD</option>
                <option value="bkin">BKin</option>
                <option value="bmus">BMus</option>
                <option value="mba">MBA</option>
                <option value="ma">MA</option>
                <option value="masc">MASc</option>
                <option value="med">MEd</option>
                <option value="llm">LLM</option>
              </select>
            </div>

            <div class="form-group">
              Faculty: &nbsp;
              <select name="faculty">
                <option value="artssci">Arts & Science</option>
                <option value="eng">Engineering</option>
                <option value="phe">Physical Health Education</option>
                <option value="comp">Computing</option>
                <option value="bus">Business</option>
                <option value="nurs">Nursing</option>
                <option value="edu">Education</option>
                <option value="kin">Kinesiology</option>
                <option value="heal">Health Sciences</option>
                <option value="pol">Policy Studies</option>
              </select>
            </div>
            <hr class="small"></hr>
            <div class="form-group">
              <input class="btn btn-default btn-lg" type='submit' id='updateBtn' name='updateBtn' value='Update Account' />
            </div>

        </form>
      </div>
    </div>
  </div>
</section>

    <!-- Edit Account Form Here -->

  <!-- jQuery -->
  <script src="js/jquery.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>

</body>

</html>
