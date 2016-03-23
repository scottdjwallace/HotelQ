<?php
  //Create a user session or resume an existing one
  session_start();
?>
<?php
  include_once 'conn.php';

  $query = "DELETE FROM premium WHERE premium.member_id = ?;
            DELETE FROM comment WHERE comment.member_id = ?;
            DELETE FROM booking WHERE booking.member_id = ?;
            DELETE FROM owns WHERE owns.member_id = ?;
            DELETE FROM property WHERE property.member_id = ?;
            DELETE FROM member WHERE member.member_id = ?;";

  $stmt = $con->prepare($query);

  // bind params
  //error here
  $stmt->bind_param('ssssss', $_SESSION['member_id'], $_SESSION['member_id'], $_SESSION['member_id'], $_SESSION['member_id'], $_SESSION['member_id'], $_SESSION['member_id']);

  // Execute the query
  if($stmt->execute()){
    header("Location: ../index.php?logout=1");
    die();
  }else{
      echo 'Unable to cancel member. Please try again. <br/>';
  }


?>
