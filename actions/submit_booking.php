<?php
  //Create a user session or resume an existing one
 session_start();
?>

<?php
  include_once 'conn.php';

  //$booking_id;
  $id = array("20000007","20000008","20000009","20000010","20000011","20000012","20000013");

  // generate booking_id
  $query = "SELECT * FROM booking";
  $stmt = $con->prepare($query);
  $stmt->execute();
  $result = $stmt->get_result();
  $num = $result->num_rows;;
  $booking_id = $id[$num - 6];

  $property_id = $_GET['property_id'];
  $period = $_POST['availability'];

	$query = "INSERT INTO booking VALUES (?,?,?,?,\"Pending\")";
  $stmt = $con->prepare($query);
  $stmt->bind_param('ssss', $booking_id, $_SESSION['member_id'], $property_id, $period);
  // Execute the query
  if($stmt->execute()){
    header("Location: ../bookings.php");
    die();
  }
  else {
    echo "$stmt->error";
  }

?>
