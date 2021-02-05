<?php
session_start();
if(isset($_SESSION['u_id'])){
   $id = $_SESSION['u_id'];
 }
date_default_timezone_set('Canada/Pacific');
if (isset($_POST['P_submit'])) {
  include_once "connection.php";

  $file = $_FILES["profileimg"]["tmp_name"];
  $pPic = file_get_contents($file);

if($file == NULL){
    header("Location: ../Profile.php?fieldsleftblank");
    exit();
}else{

  $stmt = "UPDATE Users SET profilePic = ? WHERE userName = ?";
             if($sql = $conn->prepare($stmt)){
                 $null = NULL;
                 $sql->bind_param("bs",$null, $id);
                 $sql->send_long_data(0,$pPic);
                 $sql->execute();
                header("Location: ../Profile.php");
               } else {
                   $error = $conn->errno . ' ' . $conn->error;
                   echo $error;
               }

}
}else{
  header("Location: ../Profile.php?3");
  exit();
}

 ?>
