<?php
session_start();
if(isset($_SESSION['u_id'])){
  $id = $_SESSION['u_id'];
  include_once "connection.php";
  if(isset($_POST["blogId"]))
   {
    $blogId=$_POST['blogId'];
    $sql1 = "SELECT userName FROM LikePost WHERE blogId=".$blogId.";";
     $result = mysqli_query($conn, $sql1);
     $resultCheck = mysqli_num_rows($result);
     $likedboolean=0;
     while ($row = mysqli_fetch_assoc($result)) {
       if($row['userName']==$id){
         $likedboolean=1;
         break;
       }}
       if($likedboolean==0){
          $stmt = "INSERT INTO LikePost(blogId,userName) VALUES (?,?)";
           if($sql = $conn->prepare($stmt)){
               $sql->bind_param("ss",$blogId,$id);
               $sql->execute();
               $likedboolean=0;
               }
           else {
               $error = $conn->errno . ' ' . $conn->error;
               echo $error;
             }}}}
else{
    header("Location: signup.php");
    exit();

}


 ?>
