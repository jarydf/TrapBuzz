<?php
session_start();
if(isset($_SESSION['u_id'])){
   $id = $_SESSION['u_id'];
   $fname = $_SESSION['u_first'];
   $lname = $_SESSION['u_last'];
   $email = $_SESSION['u_email'];
   $aboutMe=$_SESSION['aboutMe'];
 }

?>

<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="utf-8">
  <title>TrapBuzz - New Post</title>
  <link rel="logo icon" href="../client/images/TrapBuzz_icon.ico" />
  <link rel="stylesheet" href="../client/css/reset.css">
  <link rel="stylesheet" href="../client/css/home.css">
  <link rel="stylesheet" href="../client/css/styling1.css">
  <link rel="stylesheet" href="../client/css/Profile.css">
  <script type="text/javascript" src="../client/javascript/dropdown.js"></script>
  <script type="text/javascript" src="../client/javascript/validation.js"></script>
  <script type="text/javascript" src="../client/javascript/Profile.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src = "../client/javascript/jquery-3.1.1.min.js"></script>
</head>

<body>
  <header>
    <a href="Home.php" title="Home"> <img class = "icons" id = "logo" src="../client/images/TrapBuzz.png" alt="logo"></a>
    <form method="get" name="header_search" action="Home-search.php" onsubmit="return validateSearch()">
      <input id="search" type="search" name="searchbtn" placeholder="Search">
      <input id="submit_search" type="submit" name="submit_search1" value="Search">
    </form>
    <nav>
      <ul>
        <li> <?php if(isset($_SESSION['u_id'])){ echo "Logged in: ". $fname; }
          ?> </li>
        <li><a href="Home.php"> <img class = "icons" src="../client/images\006-home-page.svg" title="Home" alt="Home"/></a></li>
        <div class="dropdown">
          <img onclick="myFunction()" class="dropbtn" title="Menu" src="../client/images/menu.svg">
          <div id="myDropdown" class="dropdown-content">

            <?php if (isset($_SESSION['u_id'])){
                echo '<form action = "include/logout-inc.php" method="post">
                <button type = "submit" name="submit" class ="btn_nav" >Log out</button>
                  </form>';
          }else{
          echo '  <form action = "include/logout-inc.php" method="post">
              <button type = "submit" name="submit" class ="btn_nav" >Log in</button>
            </form>';
              }
              ?>
          </div>
        </div>
        <li> <?php if(isset($_SESSION['u_id'])){ echo'<a href="Profile.php"> <img class = "icons" src="../client/images\005-man-user.svg" title="Profile" alt="Profile"/></a>';}else{
          echo '<img onclick="on()" class = "icons" src="../client/images\005-man-user.svg" title="Profile" alt="Profile"/>';
        }?></li>
        <li> <?php if(isset($_SESSION['u_id'])){ echo'<a href="BlogPost.php"> <img class = "icons" src="../client/images\004-pencil-edit-button.svg" title="New Post" alt="New post"/></a>';}
        else{
          echo '<img onclick="on()" class = "icons" src="../client/images\004-pencil-edit-button.svg" title="New Post" alt="New post"/>';
        }?></li>
      </ul>

    </nav>
  </header>

  <form id="newpost" method="post" action="include/newpost-inc.php" enctype="multipart/form-data">
    <fieldset>
      <legend id="post_title">New Blog Post</legend>
      <p>
        <label>Title: </label>
        <input type="text" name="title" placeholder="Your blog title!" style="width: 40em;"/>
      </p>
      <p>
        <p>Blog:</p>
        <textarea id = "new_blog" name="blog" form="newpost" placeholder="Your blog post!"></textarea>
      </p>
<P>
  <p>Blog type:</p>
  						<select name="types">
  							<option disabled selected>Blog type</option>
  							<option value="Sports">Sports</option>
  						  <option value="Entertainment">Entertainment</option>
                <option value="Music">Music</option>
                <option value="Technology">Technology</option>
                <option value="Travel">Travel</option>
                <option value="Other">Other</option>
  						</select>
</P>
      <p>
        <label>Blog image: </label>
        <input type="file" name="img" accept=".jpeg, .jpg, .png">
        <p>
          <input class="btn" type="submit" name="blog_submit" value="Post">
          <input class="btn" type="reset">
    </fieldset>
  </form>

  <div id="overlay" onclick="off()">
  <div id="text">Oops! You're not logged in.</div>
 </div>

  <footer>
    <em>Copyright &copy; 2018 TRAPBUZZ - ALL RIGHTS RESERVED</em>
  </footer>
</body>

</html>
