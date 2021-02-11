<?php
session_start();
date_default_timezone_set('Canada/Pacific');
if (!empty($_POST['title']) && !empty($_POST['blog']) && !empty($_POST["types"]) && $_FILES['img']) {
  include_once "connection.php";
  $id = $_SESSION['u_id'];
  $bTitle = mysqli_real_escape_string($conn, $_POST['title']);
  $bContent = mysqli_real_escape_string($conn, $_POST['blog']);
  $bDate = date("Y-m-d H:i:s");
  $bType = $_POST['types'];
  $file = $_FILES["img"]["tmp_name"];
  $bPic = file_get_contents($file);
  $sqlformat = "ssssbs";
  $filesize=filesize($file);
  $errorimg = $_FILES["img"]["error"];

  if ($file == NULL || $filesize > 500000 || $errorimg > 0) {
    echo "fail2";
    exit();
  } else {
    $stmt = "INSERT INTO blogPost(blogTitle, blogContent, blogDate, blogType, blogPic, userName) VALUES (?,?,?,?,?,?)";
    if ($sql = $conn->prepare($stmt)) {
      $bTitle = stripslashes($bTitle);
      $bContent = stripslashes($bContent);
      $null = null;
      $sql->bind_param($sqlformat, $bTitle, $bContent, $bDate, $bType, $null, $id);
      $sql->send_long_data(4, $bPic);
      $sql->execute();
      echo "success";
      exit();
    } else {
      echo "fail1";
      exit();
    }
  }
} else {
  echo "fail";
  exit();
}
