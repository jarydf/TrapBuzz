<?php
session_start();
if(isset($_SESSION['u_id'])){
   $id = $_SESSION['u_id'];
   $fname = $_SESSION['u_first'];
   $lname = $_SESSION['u_last'];
   $email = $_SESSION['u_email'];
   $aboutMe=$_SESSION['aboutMe'];
}
// this function takes in userid, firstname, lastname, and email and dislpays it
  function displayContent_info($param1, $param2, $param3, $param4){
       echo'
           <p >  First name: <br>' .$param2.'</p>
           <p >  Last name: <br>'.$param3.'</p>
           <p > Username: <br>'.$param1.'</p>
           <p > Email: <br>'.$param4.'</p>';
     }
     function displayContent_blogs($param1, $param2, $param3, $param4, $param5, $param6, $param7){
       if(isset($_SESSION['u_id'])){
       $id = $_SESSION['u_id'];
     }
       echo'<div class="post">
       <form method = "post" action = "deletePost.php">
     <input input id = "submitComment" type="submit" name="delete_blog" value="Delete Post">
      <input type="hidden" name= "blog_id" value='.$param7.'>
     </form>
         <h3 style = " border-bottom: 1px solid black;" id = "blog_title">'.$param1.'</h3>
         <p> <a href="userprofile.php?username='.$param2.'"> <img class = "profilepic" src="005-man-user.svg" alt="Profile"/></a> by ' .$param2. ' on ' .$param3. ' at ' .$param4.'</p>
        <img id = "blog_pic" src="data:image/png;base64, '.base64_encode($param6).'" alt="Profile"/>         <p>'.$param5.' </p>
        <div class="numOfLikes"></div>Likes <p class="blogIdlike" style="display: none">'.$param7.'</p>
      </div>
      <div class="comments">
       <a class="newlike" href="newLikePost.php" id="'.$param7.'"><img src="002-thumbs-up-hand-symbol.svg" class="candl"/></a>
       <form id="'.$param7.'"class="comment-form" method="post" action="insertComments.php">
         <p class="blogId" style="display: none">'.$param7.'</p>
         <p style = "text-align: left;"> Comment Section <p>
         <textarea id="'.$param7.'" type="text" class="commentContent" placeholder="Add a Comment"></textarea>
         <div>
           <input type="submit" class="btn-submit" id="submitComment" value="Post" />
         </div>
       </form>
       <div class="output">
       </div>
     </div>
     <hr>';
          }
        function query_all()
              {
                include'connection.php';
                if(isset($_SESSION['u_id'])){
                   $id = $_SESSION['u_id'];
                   $fname = $_SESSION['u_first'];
                   $lname = $_SESSION['u_last'];
                   $email = $_SESSION['u_email'];
                  if ($conn->connect_error) {
                      die("Connection failed:" . $conn->connect_error);
                  }
                  $sql = "     SELECT *
                               FROM blogPost
                               WHERE blogPost.userName = \"$id\"
                               ORDER BY blogDate DESC;";
                  $result = mysqli_query($conn, $sql);
                  return $result;
                }
              }
              function query_aboutMe()
                    {
                      include'connection.php';
                      if(isset($_SESSION['u_id'])){
                         $id = $_SESSION['u_id'];
                         $aboutMe=$_SESSION['aboutMe'];
                        if ($conn->connect_error) {
                            die("Connection failed:" . $conn->connect_error);
                        }
                        $sql = "     SELECT aboutMe
                                     FROM Users
                                     WHERE userName = \"$id\";";
                        $result = mysqli_query($conn, $sql);
                        return $result;
                      }
                    }

              function display_ProfilePic(){

                include'connection.php';
                if(isset($_SESSION['u_id'])){
                   $id = $_SESSION['u_id'];
                  if ($conn->connect_error) {
                      die("Connection failed:" . $conn->connect_error);
                  }
                  $sql = "     SELECT profilePic
                               FROM Users
                               WHERE Users.userName = \"$id\";";
                  $result = mysqli_query($conn, $sql);
                  return $result;
                }
              }
              function query_search($search){
                include'connection.php';
                  if ($conn->connect_error) {
                      die("Connection failed:" . $conn->connect_error);
                  }
                  $sql = "     SELECT *
                               FROM blogPost
                               WHERE blogTitle LIKE \"%$search%\"
                               ORDER BY blogDate DESC;";
                  $result = mysqli_query($conn, $sql);
                  return $result;

              }



?>
<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="utf-8">
  <title>TrapBuzz - Home</title>
  <link rel="logo icon" href="TrapBuzz_icon.ico" />
  <link rel="stylesheet" href="reset.css">
  <link rel="stylesheet" href="home.css">
  <link rel="stylesheet" href="styling1.css">
  <link rel="stylesheet" href="Profile.css">

  <script type="text/javascript" src="dropdown.js"></script>
  <script type="text/javascript" src="validation.js"></script>
  <script type="text/javascript" src="Profile.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src = "jquery-3.1.1.min.js"></script>
</head>
<body>
  <header>
    <a href="Home.php" title="Home"> <img class = "icons" id = "logo" src="TrapBuzz.png" alt="logo"></a>
    <form method="get" name="header_search" action="Home-search.php" onsubmit="return validateSearch()">
      <input id="search" type="search" name="searchbtn" placeholder="Search">
      <input id="submit_search" type="submit" name="submit_search1" value="Search">
    </form>
    <nav>
      <ul>
        <li> <?php if(isset($_SESSION['u_id'])){ echo "Logged in: ". $fname; }
          ?> </li>
        <li><a href="Home.php"> <img class = "icons" src="006-home-page.svg" title="Home" alt="Home"/></a></li>

        <div class="dropdown">
          <img onclick="myFunction()" class="dropbtn" title="Menu" src="menu.svg">
          <div id="myDropdown" class="dropdown-content">

            <?php if (isset($_SESSION['u_id'])){
                echo '<form action = "logout-inc.php" method="post">
                <button type = "submit" name="submit" class ="btn_nav" >Log out</button>
                  </form>';
          }else{
          echo '  <form action = "logout-inc.php" method="post">
              <button type = "submit" name="submit" class ="btn_nav" >Log in</button>
            </form>';
              }
              ?>
          </div>
        </div>
        <li> <?php if(isset($_SESSION['u_id'])){ echo'<a href="Profile.php"> <img class = "icons" src="005-man-user.svg" title="Profile" alt="Profile"/></a>';}else{
          echo '<img onclick="on()" class = "icons" src="005-man-user.svg" title="Profile" alt="Profile"/>';
        }?></li>
        <li> <?php if(isset($_SESSION['u_id'])){ echo'<a href="BlogPost.php"> <img class = "icons" src="004-pencil-edit-button.svg" title="New Post" alt="New post"/></a>';}
        else{
          echo '<img onclick="on()" class = "icons" src="004-pencil-edit-button.svg" title="New Post" alt="New post"/>';
        }?></li>
      </ul>
    </nav>
  </header>
  <div id="main">
    <div id="main_column">
        <h3 id = "blog_title" style="color: white;"> About Me!</h3>
        <div style=" background-color: #FFFFFF; height: 5em;">
          <?php
          $result = query_aboutMe();
             $resultCheck = mysqli_num_rows($result);
             if ($resultCheck > 0) {
                 while ($row = mysqli_fetch_assoc($result)) {
                   if($row['aboutMe']==null){
                     echo "<p>No bio Set. Click on edit profile to set one!</p>";
                   }else{
                   echo "<p>".$row['aboutMe']."</p>";}
                 }
             }elseif($resultCheck <= 0){
             echo "<h1> You haven't posted a bio yet!</h1>";
           }
           ?>
        </div>
      <h1 style ='border-bottom: 1px solid black;'> Recent Posts </h1>
      <?php
      $result = query_all();
         $resultCheck = mysqli_num_rows($result);
         if ($resultCheck > 0) {
             while ($row = mysqli_fetch_assoc($result)) {
               displayContent_blogs($row['blogTitle'], $row['userName'], date('Y-m-d', strtotime($row['blogDate'])), date('h:i a' , strtotime($row['blogDate'])), $row['blogContent'], $row['blogPic'], $row['blogId']);
             }
         }elseif($resultCheck <= 0){
         echo "<h1> You haven't posted a blog yet!</h1>";

       }
       ?>
     </div>
    <div id="sidebar_column">

      <h1 class ="Trending2">Profile</h1>
      <div id="first">

        <?php

        $result = display_ProfilePic();
           $resultCheck = mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);
            if($row['profilePic'] != NULL) {
              echo '<p><img id="profileimage" src="data:image/png;base64, '.base64_encode($row['profilePic']).'" alt="Profile Picture" /></p>';
            }else{
             echo '<p><img id="profileimage" src="blankprofile.png" alt="Profile" /></p>';
         }

         ?>


        <p id="changeProfilePicture">Change profile picture  </p>
        <form id="profileimage"  method="post" action="changePic-inc.php" enctype="multipart/form-data">
                <input onchange="this.form.submit()" type="file" name="profileimg" accept=".jpeg, .jpg, .png">
                <br>
                <input type="hidden" name="P_submit" value="Change">

        </form>
      <hr>
      <div id="profilelinks">
<?php
if (isset($_SESSION['u_id'])){
   displayContent_info($id, $fname, $lname, $email);
}
?>
     </div>
      <div id="profilelinks">
          <a href="editProfile.php">
            <p id = "changep">Edit Profile</p>
          </a>
      </div>
    </div>
    </div>

    <div id="overlay" onclick="off()">
    <div id="text">Oops! You're not logged in.</div>
   </div>
   <script type="text/javascript" src="ajax.js"></script>
   <script type="text/javascript" src="ajaxLikes.js"></script>

</body>

</html>
