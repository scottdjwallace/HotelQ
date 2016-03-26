<?php

  $booking_id = $_GET['booking_id'];

  include_once 'conn.php';
  $query = "DELETE FROM booking WHERE booking_id=?";
  $stmt = $con->prepare($query);
  $stmt->bind_param('s', $booking_id);

  if($stmt->execute()){
    header("Location: ../bookings.php");
    die();
  }else{
      echo 'Unable to cancel booking. Please try again. <br/>';
  }

?>
