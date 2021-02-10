<?php
session_start();

if (isset($_POST['exist_userid']) && isset($_POST['exist_pwd'])) {
include_once "connection.php";

$uid = mysqli_real_escape_string($conn,$_POST['exist_userid']);
$pwd = mysqli_real_escape_string($conn,$_POST['exist_pwd']);

$sql = "SELECT userName, firstName, lastName, email, password,aboutMe FROM Users WHERE userName = '$uid'";
$result = mysqli_query($conn, $sql) or die("error query");
$resultCheck = mysqli_num_rows($result);

if ($resultCheck != 1) {
  echo "fail";
  exit();
}else{
if ($row = mysqli_fetch_assoc($result)){
  $salt = 'efhsdufjhdsfjksfh';
  $saltedPwd = $pwd.$salt;
  $hashedPwd = hash('sha256',$saltedPwd);
  if(strcmp($hashedPwd, $row['password']) != 0){
    echo "fail1";
    exit();
  }
  elseif (strcmp($hashedPwd, $row['password']) == 0) {

  // user password was succesful. Saving session variables
  $_SESSION['u_id'] = $row['userName'];
  $_SESSION['u_first'] = $row['firstName'];
  $_SESSION['u_last'] = $row['lastName'];
  $_SESSION['u_email'] = $row['email'];
  $_SESSION['aboutMe']=$row['aboutMe'];
  echo "success";
  exit();
    }
  }
}

}

else{
  echo "fail2";
  exit();
}

 ?>