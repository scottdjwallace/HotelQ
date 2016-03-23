<?php
  //Create a user session or resume an existing one
  session_start();
?>
<?php
  include_once 'conn.php';

  $query = "DELETE FROM premium WHERE premium.member_id=?";
  $stmt = $con->prepare($query);
  $stmt->bind_param('s', $_SESSION['member_id']);
  $stmt->execute();

  $query = "DELETE FROM comment WHERE comment.member_id=?";
  $stmt = $con->prepare($query);
  $stmt->bind_param('s', $_SESSION['member_id']);
  $stmt->execute();

  $query = "DELETE FROM booking WHERE booking.member_id=?";
  $stmt = $con->prepare($query);
  $stmt->bind_param('s', $_SESSION['member_id']);
  $stmt->execute();

  $query = "DELETE FROM owns WHERE owns.member_id=?";
  $stmt = $con->prepare($query);
  $stmt->bind_param('s', $_SESSION['member_id']);
  $stmt->execute();

  /*
  $query = "DELETE FROM property WHERE property.member_id=?"; // no member_id
  $stmt = $con->prepare($query);
  $stmt->bind_param('s', $_SESSION['member_id']);
  $stmt->execute(); */

  $query = "DELETE FROM member WHERE member.member_id=?";
  $stmt = $con->prepare($query);
  $stmt->bind_param('s', $_SESSION['member_id']);

  // Execute the final query
  if($stmt->execute()){
    header("Location: ../index.php?logout=1");
    die();
  }else{
      echo 'Unable to cancel membership. Please try again. <br/>';
  }


?>
