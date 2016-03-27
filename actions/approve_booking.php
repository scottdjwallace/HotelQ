<?php
  include_once 'conn.php';

  $property_id= $_GET['property_id'];
  $booking_id= $_GET['booking_id'];
  $query = "UPDATE booking SET status='Booked' WHERE property_id=? AND booking_id=?";

  $stmt = $con->prepare($query);

  // bind params
  $stmt->bind_param('ss', $property_id, $booking_id);

  // Execute the query
  if($stmt->execute()){
    header("Location: ../view_requests.php?property_id=$property_id");
    die();
  }else{
      echo 'Unable to approve booking. Please try again. <br/>';
  }

?>
