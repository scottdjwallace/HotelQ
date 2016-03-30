<?php
  include_once 'conn.php';

  $property_id = $_GET['property_id'];
  $member_id = $_GET['member_id'];

  $query = "SELECT * FROM comment WHERE property_id=?";
  $stmt = $con->prepare($query);
  $stmt->bind_param('s', $property_id);
  $stmt->execute();
  $result = $stmt->get_result();

  while($row = $result->fetch_assoc()){
    $query = "DELETE FROM reply WHERE comment_id=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('s', $row);
    $stmt->execute();
  }

  $query = "DELETE FROM comment WHERE property_id=?";
  $stmt = $con->prepare($query);
  $stmt->bind_param('s', $property_id);
  $stmt->execute();

  $query = "DELETE FROM has_feature WHERE property_id=?"; // no member_id
  $stmt = $con->prepare($query);
  $stmt->bind_param('s', $property_id);
  $stmt->execute();

  $query = "DELETE FROM booking WHERE property_id=?"; // no member_id
  $stmt = $con->prepare($query);
  $stmt->bind_param('s', $property_id);
  $stmt->execute();

  $query = "DELETE FROM owns WHERE member_id=? AND property_id=?"; // no member_id
  $stmt = $con->prepare($query);
  $stmt->bind_param('ss', $member_id, $property_id);
  $stmt->execute();

  $query = "DELETE FROM property WHERE property_id=?"; // no member_id
  $stmt = $con->prepare($query);
  $stmt->bind_param('s', $property_id);

  // Execute the final query
  if($stmt->execute()){
    header("Location: ../admin_manage.php");
    die();
  }else{
      echo 'Unable to delete property. Please try again. <br/>';
  }


?>
<?php
  //Create a user session or resume an existing one
  session_start();
?>
<?php
  include_once 'conn.php';

  $property_id = $_GET['property_id'];

  $query = "SELECT * FROM comment WHERE property_id=?";
  $stmt = $con->prepare($query);
  $stmt->bind_param('s', $property_id);
  $stmt->execute();
  $result = $stmt->get_result();

  while($row = $result->fetch_assoc()){
    $query = "DELETE FROM reply WHERE comment_id=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('s', $row);
    $stmt->execute();
  }

  $query = "DELETE FROM comment WHERE property_id=?";
  $stmt = $con->prepare($query);
  $stmt->bind_param('s', $property_id);
  $stmt->execute();

  $query = "DELETE FROM has_feature WHERE property_id=?"; // no member_id
  $stmt = $con->prepare($query);
  $stmt->bind_param('s', $property_id);
  $stmt->execute();

  $query = "DELETE FROM booking WHERE property_id=?"; // no member_id
  $stmt = $con->prepare($query);
  $stmt->bind_param('s', $property_id);
  $stmt->execute();

  $query = "DELETE FROM owns WHERE member_id=? AND property_id=?"; // no member_id
  $stmt = $con->prepare($query);
  $stmt->bind_param('ss', $_SESSION['member_id'], $property_id);
  $stmt->execute();

  $query = "DELETE FROM property WHERE property_id=?"; // no member_id
  $stmt = $con->prepare($query);
  $stmt->bind_param('s', $property_id);

  // Execute the final query
  if($stmt->execute()){
    header("Location: ../admin_manage.php");
    die();
  }else{
      echo 'Unable to delete property. Please try again. <br/>';
  }


?>
