<?php
session_start();
if(isset($_SESSION['u_id'])){
   $id = $_SESSION['u_id'];
   $fname = $_SESSION['u_first'];
   $lname = $_SESSION['u_last'];
   $email = $_SESSION['u_email'];
   $aboutMe=$_SESSION['aboutMe'];
 }
 else {
   header("Location: signup.php");
   exit();
 }

?>

<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="utf-8">
  <title>TrapBuzz - New Post</title>
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
    <form method="get" name="header_search" action="http://www.randyconnolly.com/tests/process.php" onsubmit="return validateSearch()">
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

  <form id="editProfile" method="post" action="editProfile-inc.php" enctype="multipart/form-data">
    <fieldset>
      <legend id="post_title">Edit Profile</legend>
      <br>
      <br>
      <p>
          <label>firstname: </label>
        <input class="signup_input1" type="text" name="Fname" placeholder="<?php echo $fname;?>" style="width: 40em;"/>
        </p>
        <p>
          <label>lastname: </label>
        <input class="signup_input1" type="text" name="Lname" placeholder="<?php echo $lname;?>" style="width: 40em;"/>
        </p>
        <p>
          <label>Email: </label>
          <input class="signup_input2" type="email" name="useremail" placeholder="<?php echo $email;?>" style="width: 40em;"/>
          </p>
          <p>
          <label>password: </label>
        <input class="signup_input2" type="password" name="userpwd" placeholder="" style="width: 40em;"/>
        </p>
      </p>
      <p>
        <p>About Me:</p>
        <textarea id = "new_blog" name="aboutMe" form="editProfile" placeholder="<?php echo $aboutMe;?>" value="post"></textarea>
      </p>
          <input id="submit_2" class="btn" type="submit" name="submitEditProfile" value="Confirm">
          <input class="btn" type="reset">
    </fieldset>
  </form>

  <div id="overlay" onclick="off()">
  <div id="text">Oops! You're not logged in.</div>
 </div>


</body>

</html>
