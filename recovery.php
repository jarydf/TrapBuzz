<?php

if(isset($_GET["error"])){
   $emailError = $_GET["error"];
 ?>

 <!DOCTYPE html>
 <html>

 <head lang="en">
   <meta charset="utf-8">
   <title>Password Recover</title>
   <link rel="logo icon" href="TrapBuzz_icon.ico" />
   <link rel="stylesheet" href="reset.css">
   <link rel="stylesheet" href="recovery.css">
 </head>

 <body>
   <header>
     <a href="signup.php" title="Sign in"> <img class = "icons" id = "logo" src="TrapBuzz.png" alt="logo"></a>
     <p>Password recovery</p>
   </header>
   <div id="password_recover">
     <h3 style="color: red;"> No user with the email <?php echo" $emailError "; ?> exists!</h3>
      <h3> Please enter your email </h3>
     <form name = "recoverForm" method="post" action="emailRecovery-include.php">
       <input id="email_recovery" type="email" name="email_recover" placeholder="Email">
       <input id="submit_recover" type="submit" name="recover" value="Recover">
     </form>
   </div>
 </body>

 </html>






<?php
}else {
 ?>


 <!DOCTYPE html>
 <html>

 <head lang="en">
   <meta charset="utf-8">
   <title>Password Recover</title>
   <link rel="logo icon" href="TrapBuzz_icon.ico" />
   <link rel="stylesheet" href="reset.css">
   <link rel="stylesheet" href="recovery.css">
 </head>

 <body>
   <header>
     <a href="signup.php" title="Sign in"> <img class = "icons" id = "logo" src="TrapBuzz.png" alt="logo"></a>
     <p>Password recovery</p>
   </header>
   <div id="password_recover">
     <h1>Dont worry, We have you covered.</h1>
     <h3> Please enter your email </h3>
     <form name = "recoverForm" method="post" action="emailRecovery-include.php">
       <input id="email_recovery" type="email" name="email_recover" placeholder="Email">
       <input id="submit_recover" type="submit" name="recover" value="Recover">
     </form>
   </div>
 </body>

 </html>


<?php
}
 ?>
