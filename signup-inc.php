<?php

if (isset($_POST['submit_Signup'])) {
include_once "connection.php";

  $fName = mysqli_real_escape_string($conn,$_POST['Fname']);
  $lName = mysqli_real_escape_string($conn,$_POST['Lname']);
  $userId = mysqli_real_escape_string($conn,$_POST['userid']);
  $email = mysqli_real_escape_string($conn,$_POST['useremail']);
  $pwd = mysqli_real_escape_string($conn,$_POST['userpwd']);

$sql = "SELECT * FROM Users WHERE userName = '$userId' OR email = '$email' ";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

if($resultCheck > 0){
  $name_error = "User name is taken";
  header("Location: signup.php?signup=useroremailtaken");
}else{
  if(empty($fName) || empty($lName) || empty($userId) || empty($email) || empty($pwd)){
      header("Location: signup.php?fieldsleftblank");
      exit();
  }else{
  $salt = 'efhsdufjhdsfjksfh';
  $saltedPwd = $pwd . $salt;
  $hashedPwd = hash('sha256',$saltedPwd);

  $stmt = "INSERT INTO Users (userName, firstName, lastName, email, password) VALUES (?,?,?,?,?)";
               if($sql = $conn->prepare($stmt)){
                   $sql->bind_param("sssss", $userId,$fName,$lName,$email,$hashedPwd);
                   $sql->execute();
               } else {
                   $error = $conn->errno . ' ' . $conn->error;
                   echo $error;
               }
               header("Location: newuser-inc.php");
}}

}else{
  header("Location: signup.php");
  exit();
}

 ?>
