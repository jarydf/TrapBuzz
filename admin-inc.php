<?php
session_start();

if (isset($_POST['adminSignin'])) {
include_once "connection.php";

$aid = mysqli_real_escape_string($conn,$_POST['adminUser']);
$apwd = mysqli_real_escape_string($conn,$_POST['adminPass']);

$sql = "SELECT * FROM Admin WHERE userAdmin = '$aid'";
$result = mysqli_query($conn, $sql) or die("error query");
$resultCheck = mysqli_num_rows($result);

if ($resultCheck < 1) {
    header("Location: ../admin_signin.php?login=error1");
  exit();
}else{
if ($row = mysqli_fetch_assoc($result)){
  if(strcmp($apwd, $row['passwordAdmin']) != 0){
    header("Location: ../admin_signin.php?login=error2");
    exit();
  }elseif (strcmp($apwd, $row['passwordAdmin']) == 0) {

  // user password was succesful. Saving session variables
  $_SESSION['a_id'] = $row['userAdmin'];
  header("Location: ../admin.php");
  exit();
    }
  }
}

}

else{
    header("Location: ../admin_signin.php?login=error3");
  exit();
}

 ?>
