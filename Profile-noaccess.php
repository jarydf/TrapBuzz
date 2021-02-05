<?php
session_start();
if(isset($_SESSION['u_id'])){
   $id = $_SESSION['u_id'];
   $fname = $_SESSION['u_first'];
   $lname = $_SESSION['u_last'];
   $email = $_SESSION['u_email'];
 }

date_default_timezone_set('Canada/Pacific');

// this function takes in  title, id,  date, content and picture and dislpays it
 function displayContent_blogs($param1, $param2, $param3, $param4, $param5, $param6){
   if(isset($_SESSION['u_id'])){
     echo'<a href="userprofile.php?username='.$param2.'"><div class="post">
       <h3 style = " border-bottom: 1px solid black;" id = "blog_title">'.$param1.'</h3>
       <p> <img class = "profilepic" src="005-man-user.svg" alt="Profile"/> by ' .$param2. ' on ' .$param3. ' at ' .$param4.'</p>
       <img id = "blog_pic" src="data:image/png;base64, '.base64_encode($param6).'" alt="Profile"/>
       <p>'.$param5.' </p>
     </div>
     <div class="comments">
     <a href="#"><img src="001-comment-black-oval-bubble-shape.svg" class="candl"/></a><a href="#"><img src="002-thumbs-up-hand-symbol.svg" class="candl"/></a>
       <p>view comments</p>
     </div></a>
    <hr>';
}else{
  echo'<div class="post">
    <h3 style = " border-bottom: 1px solid black;" id = "blog_title">'.$param1.'</h3>
    <p> <a href="Profile-noaccess.php"> <img class = "profilepic" src="005-man-user.svg" alt="Profile"/></a> by ' .$param2. ' on ' .$param3. ' at ' .$param4.'</p>
    <img id = "blog_pic" src="data:image/png;base64, '.base64_encode($param6).'" alt="Profile"/>    <p>'.$param5.' </p>
  </div>
  <div class="comments">
  <a href="#"><img src="001-comment-black-oval-bubble-shape.svg" class="candl"/></a><a href="#"><img src="002-thumbs-up-hand-symbol.svg" class="candl"/></a>
    <p>view comments</p>
  </div>
 <hr>';
}
      }
  function query_all()
        {
          include'connection.php';
            if ($conn->connect_error) {
                die("Connection failed:" . $conn->connect_error);
            }
            $sql = "     SELECT *
                         FROM blogPost
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
  <?php

  echo "<h1> Sign in to view profiles!</h1>";
  echo "<h1  style ='border-bottom: 1px solid black;'> <a style= 'color:white;border-bottom: 1px solid white;'href='signup.php'> Sign in </a> </h1>";

   ?>
    </div>
    <div id="sidebar_column">

      <h1 id="Trending">Trending Posts</h1>
  
      <h1 id="Trending">Categories</h1>
      <h2><a href = "Home-types.php?type=Entertainment">Entertainment<a></h2>
      <h2><a href = "Home-types.php?type=Technology">Technology<a></h2>
      <h2><a href = "Home-types.php?type=Sports">Sports<a></h2>
      <h2><a href = "Home-types.php?type=Travel">Travel<a></h2>
      <h2><a href = "Home-types.php?type=Music">Music<a></h2>
      <h2><a href = "Home-types.php?type=Other">Other<a></h2>

    </div>
  </div>

  <div id="overlay" onclick="off()">
  <div id="text">Oops! You're not logged in.</div>
 </div>

  <footer>
    <em>Copyright &copy; 2018 TRAPBUZZ - ALL RIGHTS RESERVED</em>
  </footer>
</body>
</html>
