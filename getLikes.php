<?php
session_start();
if(isset($_SESSION['u_id'])){
  $id = $_SESSION['u_id'];
include_once "connection.php";
$blogId= isset($_POST['blogId']) ? $_POST['blogId'] : "";
$date = date('Y-m-d H:i:s');
    if ($conn->connect_error) {
        die("Connection failed:" . $conn->connect_error);
    }
    $sql = "SELECT COUNT(likeId) AS numOfLikes FROM LikePost WHERE blogId=".$blogId.";";
    $result = mysqli_query($conn, $sql);
    $count=mysqli_fetch_assoc($result);
      echo "".$count['numOfLikes'];
mysqli_free_result($result);
mysqli_close($conn);
}
else{
    header("Location: signup.php");
    exit();
}
?>
