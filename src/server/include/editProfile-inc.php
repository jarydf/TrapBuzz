<?php
session_start();
if(isset($_SESSION['u_id'])){
  $id = $_SESSION['u_id'];
  $fName = $_SESSION['u_first'];
  $lName = $_SESSION['u_last'];
  $email = $_SESSION['u_email'];
  $aboutMe=$_SESSION['aboutMe'];
  $sql = " SELECT password FROM Users WHERE userName=".$id.";";
  $result = mysqli_query($conn, $sql);
  $password=$result;
}
else {
  header("Location: ../signup.php");
  exit();
}
  if (isset($_POST['submitEditProfile'])) {
    include_once "connection.php";
    if($_POST['userpwd']==null){
      $password=$password;
    }
    else{$password=mysqli_real_escape_string($conn,$_POST['userpwd']);}
    $fName=(isset($_POST['Fname']) ? mysqli_real_escape_string($conn,$_POST['Fname']) : $fName);
    $lName=(isset($_POST['Lname']) ? mysqli_real_escape_string($conn,$_POST['Lname']) : $lName);
    $email=(isset($_POST['useremail']) ? mysqli_real_escape_string($conn,$_POST['useremail']) : $email);
    $aboutMe=(isset($_POST['aboutMe']) ? mysqli_real_escape_string($conn,$_POST['aboutMe']) : $aboutMe);
    if($fName==null){
      $fName=$_SESSION['u_first'];
    }
    if($lName==null){
      $lName=$_SESSION['u_last'];
    }
    if($email==null){
      $email=$_SESSION['u_email'];
    }
    if($aboutMe==null){
      $aboutMe=$_SESSION['aboutMe'];
    }
    if ($conn->connect_error) {
        die("Connection failed:" . $conn->connect_error);
        exit();
    }
    else{
  $salt = 'efhsdufjhdsfjksfh';
  $saltedPwd = $password . $salt;
  $hashedPwd = hash('sha256',$saltedPwd);
  $stmt = $conn->prepare("UPDATE Users SET firstname=?, lastname=?, email=?, password=?,aboutMe=? WHERE userName='".$id."';");
                     $stmt->bind_param("sssss",$fName,$lName,$email,$hashedPwd,$aboutMe);
                     $stmt->execute();
                     $_SESSION['u_id']=$id;
                     $_SESSION['u_first'] = $fName;
                     $_SESSION['u_last'] = $lName;
                     $_SESSION['u_email'] = $email;
                     $_SESSION['aboutMe']=$aboutMe;
                 header("Location: ../Profile.php");
                 exit();
               }
}
  else{
    header("Location: ../editProfile.php");
    exit();
  }
  ?>
