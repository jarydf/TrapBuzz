<?php
session_start();
if(isset($_SESSION['u_id'])){
   $id = $_SESSION['u_id'];
 }
date_default_timezone_set('Canada/Pacific');
if (isset($_POST['comment_submit'])) {
  include_once "connection.php";
  $cContent = mysqli_real_escape_string($conn,$_POST['comment']);
  $cDate = date("Y-m-d H:i:s");
  $blogId=$_POST['blogId'];

if(empty($cContent)){
    header("Location: Comments.php?fieldsleftblank");
    exit();
}else{
$stmt = "INSERT INTO Comment(commentId, commentContent, commentDate,userName,blogId) VALUES (?,?,?,?,?)";
           if($sql = $conn->prepare($stmt)){
               $null = NULL;
               $sql->bind_param("sssss",stripslashes($cContent),$cDate,$id,$blogId);
               $sql->execute();

               } else {
                   $error = $conn->errno . ' ' . $conn->error;
                   echo $error;
               }
               header("Location: Home.php");
}

}else{
  header("Location: Home.php");
  exit();
}

 ?>
