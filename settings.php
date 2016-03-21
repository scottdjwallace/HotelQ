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
                <option value="default" <?php if ($myrow['avatar'] == 'default') echo ' selected="selected"'; ?>>Default</option>
                <option value="hockey" <?php if ($myrow['avatar'] == 'hockey') echo ' selected="selected"'; ?>>Hockey</option>
                <option value="car" <?php if ($myrow['avatar'] == 'car') echo ' selected="selected"'; ?>>Car</option>
                <option value="city" <?php if ($myrow['avatar'] == 'city') echo ' selected="selected"'; ?>>City</option>
                <option value="pizza" <?php if ($myrow['avatar'] == 'pizza.') echo ' selected="selected"'; ?>>Pizza</option>
              </select>

              &nbsp; &nbsp; &nbsp; &nbsp; Degree: &nbsp;
              <select name="degree">
                <option value="bsc" <?php if ($myrow['deg_id'] == '201') echo ' selected="selected"'; ?>>BSc</option>
                <option value="bfa" <?php if ($myrow['deg_id'] == '202') echo ' selected="selected"'; ?>>BFA</option>
                <option value="beng" <?php if ($myrow['deg_id'] == '203') echo ' selected="selected"'; ?>>BEng</option>
                <option value="bphe" <?php if ($myrow['deg_id'] == '204') echo ' selected="selected"'; ?>>BPHE</option>
                <option value="ba" <?php if ($myrow['deg_id'] == '205') echo ' selected="selected"'; ?>>BA</option>
                <option value="bcmp" <?php if ($myrow['deg_id'] == '206') echo ' selected="selected"'; ?>>BCmp</option>
                <option value="bcomm" <?php if ($myrow['deg_id'] == '207') echo ' selected="selected"'; ?>>BComm</option>
                <option value="bscn" <?php if ($myrow['deg_id'] == '208') echo ' selected="selected"'; ?>>BScN</option>
                <option value="bed" <?php if ($myrow['deg_id'] == '209') echo ' selected="selected"'; ?>>BEd</option>
                <option value="msc" <?php if ($myrow['deg_id'] == '210') echo ' selected="selected"'; ?>>MSc</option>
                <option value="meng" <?php if ($myrow['deg_id'] == '211') echo ' selected="selected"'; ?>>MEng</option>
                <option value="phd" <?php if ($myrow['deg_id'] == '212') echo ' selected="selected"'; ?>>PhD</option>
                <option value="bkin" <?php if ($myrow['deg_id'] == '213') echo ' selected="selected"'; ?>>BKin</option>
                <option value="bmus" <?php if ($myrow['deg_id'] == '214') echo ' selected="selected"'; ?>>BMus</option>
                <option value="mba" <?php if ($myrow['deg_id'] == '215') echo ' selected="selected"'; ?>>MBA</option>
                <option value="ma" <?php if ($myrow['deg_id'] == '216') echo ' selected="selected"'; ?>>MA</option>
                <option value="masc" <?php if ($myrow['deg_id'] == '217') echo ' selected="selected"'; ?>>MASc</option>
                <option value="med" <?php if ($myrow['deg_id'] == '218') echo ' selected="selected"'; ?>>MEd</option>
                <option value="llm" <?php if ($myrow['deg_id'] == '219') echo ' selected="selected"'; ?>>LLM</option>
              </select>
            </div>

            <div class="form-group">
              Faculty: &nbsp;
              <select name="faculty">
                <option value="artssci" <?php if ($myrow['fac_id'] == '301') echo ' selected="selected"'; ?>>Arts & Science</option>
                <option value="eng" <?php if ($myrow['fac_id'] == '302') echo ' selected="selected"'; ?>>Engineering</option>
                <option value="phe" <?php if ($myrow['fac_id'] == '303') echo ' selected="selected"'; ?>>Physical Health Education</option>
                <option value="comp" <?php if ($myrow['fac_id'] == '304') echo ' selected="selected"'; ?>>Computing</option>
                <option value="bus" <?php if ($myrow['fac_id'] == '305') echo ' selected="selected"'; ?>>Business</option>
                <option value="nurs" <?php if ($myrow['fac_id'] == '306') echo ' selected="selected"'; ?>>Nursing</option>
                <option value="edu" <?php if ($myrow['fac_id'] == '307') echo ' selected="selected"'; ?>>Education</option>
                <option value="kin" <?php if ($myrow['fac_id'] == '308') echo ' selected="selected"'; ?>>Kinesiology</option>
                <option value="heal" <?php if ($myrow['fac_id'] == '309') echo ' selected="selected"'; ?>>Health Sciences</option>
                <option value="pol" <?php if ($myrow['fac_id'] == '310') echo ' selected="selected"'; ?>>Policy Studies</option>
              </select>
            </div>
            <hr class="small"></hr>
            <div class="form-group">
              <input class="btn btn-default btn-lg" type='submit' id='updateBtn' name='updateBtn' value='Update Account' />
            </div>

        </form>
        <form action="actions/cancel_member.php">
          <div class="form-group">
          <input class="btn btn-danger btn-lg" type='submit' id='deleteBtn' name='deleteBtn' value='Cancel Membership' />
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
