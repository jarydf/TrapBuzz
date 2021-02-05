<?php
session_start();
if(isset($_SESSION['u_id'])){
   $id = $_SESSION['u_id'];
 }
date_default_timezone_set('Canada/Pacific');
if (isset($_POST['blog_submit'])) {
  include_once "connection.php";
  $bTitle = mysqli_real_escape_string($conn,$_POST['title']);
  $bContent = mysqli_real_escape_string($conn,$_POST['blog']);
  $bDate = date("Y-m-d H:i:s");
  if(isset($_POST["types"])){
  $bType = $_POST['types'];
  $file = $_FILES["img"]["tmp_name"];
  $bPic = file_get_contents($file);
}

else{
    $bType = 'Other';
}
if(empty($bTitle) || empty($bContent) || isset($_POST["types"]) == false || $file == NULL){
    header("Location: BlogPost.php?fieldsleftblank");
    exit();
}else{


$stmt = "INSERT INTO blogPost(blogTitle, blogContent, blogDate, blogType, blogPic, userName) VALUES (?,?,?,?,?,?)";
           if($sql = $conn->prepare($stmt)){
               $null = NULL;
               $sql->bind_param("ssssbs", stripslashes($bTitle),stripslashes($bContent),$bDate,$bType,$null,$id);
               $sql->send_long_data(4,$bPic);
               $sql->execute();

               } else {
                   $error = $conn->errno . ' ' . $conn->error;
                   echo $error;
               }
               header("Location: Home.php");
}

}else{
  header("Location: BlogPost.php");
  exit();
}

 ?>
