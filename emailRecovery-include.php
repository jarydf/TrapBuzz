<?php
if (isset($_POST['recover'])) {
  include_once "connection.php";
  $recoverEmail = $_POST['email_recover'];
$sql = "SELECT email FROM Users WHERE email = '$recoverEmail'";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if($resultCheck > 0){
  $pwd = rand(999, 99999);
          $salt = 'efhsdufjhdsfjksfh';
          $saltedPwd = $pwd . $salt;
          $hashedPwd = hash('sha256',$saltedPwd);

          $sql2 = "UPDATE Users SET password = '$hashedPwd' WHERE email = '$recoverEmail'";
          mysqli_query($conn,$sql2);
          $to = $recoverEmail;
          $subject = "Password reset request: TrapBuzz";
          $txt = "A password reset request was sent to this email. Your new password is: ".$pwd. " \nTo sign in with your new password head to http://cosc360.ok.ubc.ca/44790153/src/server/signup.php \n - The TrapBuzz team!";
          $headers = "From: noman0786@hotmail.com" . "\r\n";
          mail($to, $subject, $txt, $headers);
          header("Location: resetSuccess.php");



}
else{
header("Location: recovery.php?error=$recoverEmail");
}

}



 ?>
