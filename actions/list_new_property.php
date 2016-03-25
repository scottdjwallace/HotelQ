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



  // add it to the database
  // insert into owns
	$query = "INSERT INTO property VALUES (?,?,?,?,?,?,?,?)";
  $stmt = $con->prepare($query);
  $stmt->bind_param('ssisssss', $property_id, $type, $price, $address, $city, $state, $area_code, $district_id);
  // Execute the query
  if($stmt->execute()){
    $query2 = "INSERT INTO owns VALUES (?,?)";
    $stmt2 = $con->prepare($query2);
    $stmt2->bind_param('ss',$_SESSION['member_id'],$property_id);
    if ($stmt2->execute()){
      header("Location: ../properties.php");
      die();
    }
    else {
      echo "$stmt2->error";
    }
  }
  else {
    echo "$stmt->error";
  }

?>
