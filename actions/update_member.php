<?php

if(isset($_POST['updateBtn']) && isset($_SESSION['id'])){
 // include database connection
   include_once 'actions/conn.php';

 $query = "UPDATE user SET password=?,email=? WHERE id=?";

 $stmt = $con->prepare($query);	$stmt->bind_param('sss', $_POST['password'], $_POST['email'], $_SESSION['id']);
 // Execute the query
       if($stmt->execute()){
           echo "Record was updated. <br/>";
       }else{
           echo 'Unable to update record. Please try again. <br/>';
       }
}

?>
