<?php
if (isset($_POST["blog_id"])) {
$delete_blog = $_POST["blog_id"];
  include_once "connection.php";
$stmt = "DELETE FROM blogPost WHERE blogId = ?";
           if($sql = $conn->prepare($stmt)){
               $null = NULL;
               $sql->bind_param("s",$delete_blog);
               $sql->execute();
             } else {
                 $error = $conn->errno . ' ' . $conn->error;
                 echo $error;
             }
}

 ?>

 <!DOCTYPE html>
  <html>
  <head lang="en">
    <meta charset="utf-8">
    <title>Delete Post</title>
    <link rel="logo icon" href="TrapBuzz_icon.ico" />
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="recovery.css">
  </head>

  <body>
    <header>
       <img class = "icons" id = "logo" src="TrapBuzz.png" alt="logo">
      <p>Post Deleted</p>
    </header>
    <div id="password_recover">
      <?php
      echo "<h1> Your blog post has been successfully deleted. <a href=\"Profile.php\"> Take me back to my profile. </a> </h1>";
       ?>
    </div>
  </body>

  </html>
