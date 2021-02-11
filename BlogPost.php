<?php
session_start();
if (isset($_SESSION['u_id'])) {
  $id = $_SESSION['u_id'];
  $fname = $_SESSION['u_first'];
  $lname = $_SESSION['u_last'];
  $email = $_SESSION['u_email'];
  $aboutMe = $_SESSION['aboutMe'];
}

?>

<!DOCTYPE html>
<html>

<head lang="en">
  <meta charset="utf-8">
  <title>TrapBuzz - New Post</title>
  <link rel="logo icon" href="TrapBuzz_icon.ico" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="reset.css">
  <link rel="stylesheet" href="home.css">
  <link rel="stylesheet" href="styling1.css">
  <link rel="stylesheet" href="Profile.css">
  <script type="text/javascript" src="dropdown.js"></script>
  <script type="text/javascript" src="validation.js"></script>
  <script type="text/javascript" src="Profile.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="jquery-3.1.1.min.js"></script>
</head>

<body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
  <header>
    <a href="Home.php" title="Home"> <img class="icons" id="logo" src="TrapBuzz.png" alt="logo"></a>
    <form method="get" name="header_search" action="Home-search.php" onsubmit="return validateSearch()">
      <input id="search" type="search" name="searchbtn" placeholder="Search">
      <input id="submit_search" type="submit" name="submit_search1" value="Search">
    </form>
    <nav>
      <ul>
        <li> <?php if (isset($_SESSION['u_id'])) {
                echo "Logged in: " . $fname;
              }
              ?> </li>
        <li><a href="Home.php"> <img class="icons" src="006-home-page.svg" title="Home" alt="Home" /></a></li>
        <div class="dropdown">
          <img onclick="myFunction()" class="dropbtn" title="Menu" src="menu.svg">
          <div id="myDropdown" class="dropdown-content">

            <?php if (isset($_SESSION['u_id'])) {
              echo '<form action = "logout-inc.php" method="post">
                <button type = "submit" name="submit" class ="btn_nav" >Log out</button>
                  </form>';
            } else {
              echo '  <form action = "logout-inc.php" method="post">
              <button type = "submit" name="submit" class ="btn_nav" >Log in</button>
            </form>';
            }
            ?>
          </div>
        </div>
        <li> <?php if (isset($_SESSION['u_id'])) {
                echo '<a href="Profile.php"> <img class = "icons" src="005-man-user.svg" title="Profile" alt="Profile"/></a>';
              } else {
                echo '<img onclick="on()" class = "icons" src="005-man-user.svg" title="Profile" alt="Profile"/>';
              } ?></li>
        <li> <?php if (isset($_SESSION['u_id'])) {
                echo '<a href="BlogPost.php"> <img class = "icons" src="004-pencil-edit-button.svg" title="New Post" alt="New post"/></a>';
              } else {
                echo '<img onclick="on()" class = "icons" src="004-pencil-edit-button.svg" title="New Post" alt="New post"/>';
              } ?></li>
      </ul>

    </nav>
  </header>

  <div class="col-md-4 col-md-offset-4">
    <form id="newpost" method="post" action="newpost-inc.php" enctype="multipart/form-data">
      <fieldset>
        <legend id="post_title">New Blog Post</legend>
        <div class="form-group">
          <label>Title: </label>
          <input type="text" name="title" placeholder="Your blog title!" style="width: 40em;" id="blogpost_title" />
        </div>
        <div class="form-group">
          <label>Blog:</label>
          <textarea id="new_blog" name="blog" form="newpost" placeholder="Your blog post!"></textarea>
        </div>
        <div class="form-group">
          <label>Blog type:</label>
          <select name="types" id="blogpost_types">
            <option disabled selected>Blog type</option>
            <option value="Sports">Sports</option>
            <option value="Entertainment">Entertainment</option>
            <option value="Music">Music</option>
            <option value="Technology">Technology</option>
            <option value="Travel">Travel</option>
            <option value="Other">Other</option>
          </select>
        </div>
        <div class="form-group">
          <label>Blog image: </label>
          <input type="file" name="img" accept=".jpeg, .jpg, .png" id="blogpost_file">
          <input class="btn btn-success" type="submit" name="blog_submit" value="Post">
          <input class="btn btn-success" type="reset">
        </div>
      </fieldset>
    </form>
  </div>


  <div id="overlay" onclick="off()">
    <div id="text">Oops! You're not logged in.</div>
  </div>

  <footer>
    <em>Copyright &copy; 2018 TRAPBUZZ - ALL RIGHTS RESERVED</em>
  </footer>
  <script type="text/javascript" src="ajaxnewpost-inc.js"></script>
</body>

</html>