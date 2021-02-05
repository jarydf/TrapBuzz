<?php
session_start();
if(isset($_SESSION['u_id'])){
  $id = $_SESSION['u_id'];
include_once "connection.php";
if(isset($_POST["blogId"]))
 {
   date_default_timezone_set('Canada/Pacific');
   // $commentContent=$_POST['commentContent'];
$blogId=$_POST["blogId"];
$date = date('Y-m-d H:i:s');
$sql = "SELECT * FROM Comment WHERE blogId=".$blogId." ORDER BY commentDate DESC;";
$result = mysqli_query($conn, $sql);
 $resultCheck = mysqli_num_rows($result);
 if ($resultCheck > 0) {
     while ($row = mysqli_fetch_assoc($result)) {
       echo '
   <p style = "text-align: left;">At '.date('h:i a' , strtotime($row['commentDate'])).'  </p>
   <p style = "text-align: left;">By: '.$row['userName'].' </p>
   <p style = "text-align: left;"> '.$row['commentContent'].' </p><hr>';
   }
   }
   elseif($resultCheck <= 0){
   echo '<p class="nocomments">no comments</p>';
 }
mysqli_free_result($result);
mysqli_close($conn);
}
}
else{
    header("Location: signup.php");
    exit();
}
?>
