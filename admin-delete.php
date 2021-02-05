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
    <title>Admin - Delete Post</title>
    <link rel="logo icon" href="TrapBuzz_icon.ico" />
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="recovery.css">
  </head>

  <body>
    <header>
       <img class = "icons" id = "logo" src="TrapBuzz.png" alt="logo">
      <p>Admin - Post Deleted</p>
    </header>
    <div id="password_recover">
      <?php
      echo "<h1>You have successfully deleted the blog post. <a href=\"admin.php\"> Back to the admin page. </a> </h1>";
       ?>
    </div>
  </body>

  </html>
