<?php
  //Create a user session or resume an existing one
  session_start();
?>
<?php
  include_once 'conn.php';

  $property_id= $_GET['property_id'];

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



  $query = "UPDATE property SET type=?, price=?, address=?, city=?, state=?, area_code=?, district_id=? WHERE property_id=?";

  $stmt = $con->prepare($query);

  // bind params
  $stmt->bind_param('sissssss', $type, $price, $address, $city, $state, $area_code, $district_id, $property_id);

  // Execute the query
  if($stmt->execute()){
    header("Location: ../properties.php");
    die();
  }else{
      echo 'Unable to update property. Please try again. <br/>';
  }

?>
