<?php
  //Create a user session or resume an existing one
 session_start();
?>

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
  $address = $_POST['address'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $area_code = $_POST['area_code'];
  $district_id = $_POST['district'];

  $typeSelected = $_POST['type'];
  $type = "1 Bedroom Apt";
  if ($typeSelected=="oneBed"){
    $type = "1 Bedroom Apt";
  }
  elseif ($typeSelected=="twoBed"){
    $type = "2 Bedroom Apt";
  }
  elseif ($typeSelected=="threeBed"){
    $type = "3 Bedroom Apt";
  }
  elseif ($typeSelected=="fourBed"){
    $type = "4 Bedroom Apt";
  }
  elseif ($typeSelected=="studio"){
    $type = "Studio";
  }

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

  // add it to the database
  // insert into owns
	$query = "INSERT INTO property VALUES (?,?,?,?,NULL,?,?,?,?)";
  $stmt = $con->prepare($query);
  $stmt->bind_param('ssisssss', $property_id, $type, $price, $address, $city, $state, $area_code, $district_id);
  // Execute the query
  if($stmt->execute()){
    $query2 = "INSERT INTO owns VALUES (?,?)";
    $stmt2 = $con->prepare($query2);
    $stmt2->bind_param('ss',$_SESSION['member_id'],$property_id);
    if ($stmt2->execute()){
      if ($shared!=""){
        $query3 = "INSERT INTO has_feature VALUES (?,?)";
        $stmt3 = $con->prepare($query3);
        $stmt3->bind_param('ss',$shared,$property_id);
        $stmt3->execute();
      }
      if ($private!=""){
        $query3 = "INSERT INTO has_feature VALUES (?,?)";
        $stmt3 = $con->prepare($query3);
        $stmt3->bind_param('ss',$private,$property_id);
        $stmt3->execute();
      }
      if ($close_to_subway!=""){
        $query3 = "INSERT INTO has_feature VALUES (?,?)";
        $stmt3 = $con->prepare($query3);
        $stmt3->bind_param('ss',$close_to_subway,$property_id);
        $stmt3->execute();
      }
      if ($pool!=""){
        $query3 = "INSERT INTO has_feature VALUES (?,?)";
        $stmt3 = $con->prepare($query3);
        $stmt3->bind_param('ss',$pool,$property_id);
        $stmt3->execute();
      }
      if ($full_kitchen!=""){
        $query3 = "INSERT INTO has_feature VALUES (?,?)";
        $stmt3 = $con->prepare($query3);
        $stmt3->bind_param('ss',$full_kitchen,$property_id);
        $stmt3->execute();
      }
      if ($laundry!=""){
        $query3 = "INSERT INTO has_feature VALUES (?,?)";
        $stmt3 = $con->prepare($query3);
        $stmt3->bind_param('ss',$laundry,$property_id);
        $stmt3->execute();
      }
      if ($smoke_free!=""){
        $query3 = "INSERT INTO has_feature VALUES (?,?)";
        $stmt3 = $con->prepare($query3);
        $stmt3->bind_param('ss',$smoke_free,$property_id);
        $stmt3->execute();
      }
      if ($scent_free!=""){
        $query3 = "INSERT INTO has_feature VALUES (?,?)";
        $stmt3 = $con->prepare($query3);
        $stmt3->bind_param('ss',$scent_free,$property_id);
        $stmt3->execute();
      }
      if ($balcony!=""){
        $query3 = "INSERT INTO has_feature VALUES (?,?)";
        $stmt3 = $con->prepare($query3);
        $stmt3->bind_param('ss',$balcony,$property_id);
        $stmt3->execute();
      }
      if ($gym!=""){
        $query3 = "INSERT INTO has_feature VALUES (?,?)";
        $stmt3 = $con->prepare($query3);
        $stmt3->bind_param('ss',$gym,$property_id);
        $stmt3->execute();
      }
      if ($office!=""){
        $query3 = "INSERT INTO has_feature VALUES (?,?)";
        $stmt3 = $con->prepare($query3);
        $stmt3->bind_param('ss',$office,$property_id);
        $stmt3->execute();
      }
      if ($dishwasher!=""){
        $query3 = "INSERT INTO has_feature VALUES (?,?)";
        $stmt3 = $con->prepare($query3);
        $stmt3->bind_param('ss',$dishwasher,$property_id);
        $stmt3->execute();
      }
      if ($internet!=""){
        $query3 = "INSERT INTO has_feature VALUES (?,?)";
        $stmt3 = $con->prepare($query3);
        $stmt3->bind_param('ss',$internet,$property_id);
        $stmt3->execute();
      }
      if ($jacuzzi!=""){
        $query3 = "INSERT INTO has_feature VALUES (?,?)";
        $stmt3 = $con->prepare($query3);
        $stmt3->bind_param('ss',$jacuzzi,$property_id);
        $stmt3->execute();
      }
      header("Location: ../properties.php");
      die();
    }
    else {
      echo $stmt2->error;
    }
  }
  else {
    echo "$stmt->error";
  }

?>
