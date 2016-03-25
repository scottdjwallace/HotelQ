<?php
  include_once 'conn.php';

  $id = array("10000007","10000008","10000009","10000010","10000011","10000012","10000013","10000014","10000015","10000016","10000017","10000018","10000019","10000020","10000021","10000022","10000023","10000024","10000025","10000026","10000027","10000028","10000029");

  // generate member_id
  $query = "SELECT * FROM owns";
  $stmt = $con->prepare($query);
  $stmt->execute();
  $result = $stmt->get_result();
  $num = $result->num_rows;;
  $property_id = $id[$num - 6]; // because started with 6 members

  $price = $_POST['price'];
  $address = $_POST['']

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
    header("Location: ../properties.php");
    die();
  }
  else {
    echo "$stmt->error";
  }

?>
