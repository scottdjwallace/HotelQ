<?php

if(isset($_POST['updateBtn']) && isset($_SESSION['id'])){
 // include database connection
   include_once 'actions/conn.php';

 $query = "UPDATE user SET password=?,email=? WHERE id=?";

 $stmt = $con->prepare($query);	$stmt->bind_param('sss', $_POST['password'], $_POST['email'], $_SESSION['id']);
 // Execute the query
       if($stmt->execute()){
           echo "Record was updated. <br/>";
       }else{
           echo 'Unable to update record. Please try again. <br/>';
       }
}

?>

<?php
  include_once 'conn.php';

  //$query = "UPDATE member SET email=?,password=?,avatar=?, WHERE member_id=?";

  $email = $_POST['email'];
  $password = $_POST['password'];
  $avatar = $_POST['avatar'];
  $balance = 0;
  $phone_number = $_POST['phone_number'];
  $grad_year = $_POST['grad_year'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $area_code = $_POST['area_code'];
  $is_admin = 0;

  //$faculties = array('artsci','eng','phe','comp','bus','nurs','edu','kin','heal','pol',);
  $faculty = $_POST['faculty'];
  $fac_id = "301";
  if ($faculty=="artsci") {
    $fac_id = "301";
  }
  elseif ($faculty=="eng") {
    $fac_id = "302";
  }
  elseif ($faculty=="phe") {
    $fac_id = "303";
  }
  elseif ($faculty=="comp") {
    $fac_id = "304";
  }
  elseif ($faculty=="bus") {
    $fac_id = "305";
  }
  elseif ($faculty=="nurs") {
    $fac_id = "306";
  }
  elseif ($faculty=="edu") {
    $fac_id = "307";
  }
  elseif ($faculty=="kin") {
    $fac_id = "308";
  }
  elseif ($faculty=="heal") {
    $fac_id = "309";
  }
  elseif ($faculty=="pol") {
    $fac_id = "310";
  }

  // degree -> id
  $degree = $_POST['degree'];
  $deg_id = "201";
  if ($degree=="bsc") {
    $deg_id = "201";
  }
  elseif ($degree=="bfa") {
    $deg_id = "202";
  }
  elseif ($degree=="beng") {
    $deg_id = "203";
  }
  elseif ($degree=="bphe") {
    $deg_id = "204";
  }
  elseif ($degree=="ba") {
    $deg_id = "205";
  }
  elseif ($degree=="bcmp") {
    $deg_id = "206";
  }
  elseif ($degree=="bcomm") {
    $deg_id = "207";
  }
  elseif ($degree=="bscn") {
    $deg_id = "208";
  }
  elseif ($degree=="bed") {
    $deg_id = "209";
  }
  elseif ($degree=="msc") {
    $deg_id = "210";
  }
  elseif ($degree=="meng") {
    $deg_id = "211";
  }
  elseif ($degree=="phd") {
    $deg_id = "212";
  }
  elseif ($degree=="bkin") {
    $deg_id = "213";
  }
  elseif ($degree=="bmus") {
    $deg_id = "214";
  }
  elseif ($degree=="mba") {
    $deg_id = "215";
  }
  elseif($degree=="ma") {
    $deg_id = "216";
  }
  elseif($degree=="masc") {
    $deg_id = "217";
  }
  elseif($degree=="med") {
    $deg_id = "218";
  }
  elseif($degree=="llm") {
    $deg_id = "219";
  }

  // add it to the database
	$query = "INSERT INTO member VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
  $stmt = $con->prepare($query);

  // problem here
  $stmt->bind_param('ssssissssssiss', $member_id, $email, $password, $avatar, $balance, $phone_number, $grad_year, $address, $city, $state, $area_code, $is_admin, $fac_id, $deg_id);
	// Execute the query
  if($stmt->execute()){
    echo "<p>here</p>";
    header("Location: ../index.php");
    die();
  }
  else {
    echo "$stmt->error";
  }

?>
