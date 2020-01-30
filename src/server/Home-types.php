<?php
session_start();
if(isset($_SESSION['u_id'])){
   $id = $_SESSION['u_id'];
   $fname = $_SESSION['u_first'];
   $lname = $_SESSION['u_last'];
   $email = $_SESSION['u_email'];
   $aboutMe=$_SESSION['aboutMe'];
 }

date_default_timezone_set('Canada/Pacific');

// this function takes in  title, id,  date, content and picture($param6) and dislpays it
 function displayContent_blogs($param1, $param2, $param3, $param4, $param5, $param6,$param7){
   if(isset($_SESSION['u_id'])){
   echo'<a href="userprofile.php?username='.$param2.'"><div class="post">
     <h3 style = " border-bottom: 1px solid black;" id = "blog_title">'.$param1.'</h3>
     <p> <img class = "profilepic" src="../client/images\005-man-user.svg" alt="Profile"/> by ' .$param2. ' on ' .$param3. ' at ' .$param4.'</p>
     <img id = "blog_pic" src="data:image/png;base64, '.base64_encode($param6).'" alt="Profile"/>
     <p>'.$param5.' </p>
     <div class="numOfLikes"></div>Likes <p class="blogIdlike" style="display: none">'.$param7.'</p>
   </div>

   <div class="comments">
    <a class="newlike" href="include/newLikePost.php" id="'.$param7.'"><img src="../client/images\002-thumbs-up-hand-symbol.svg" class="candl"/>
    </a>
    <form id="'.$param7.'"class="comment-form" method="post" action="include/insertComments.php">
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
}else{
  echo'<div class="post">
    <h3 style = " border-bottom: 1px solid black;" id = "blog_title">'.$param1.'</h3>
    <p> <a href="Profile-noaccess.php"> <img class = "profilepic" src="../client/images\005-man-user.svg" alt="Profile"/></a> by ' .$param2. ' on ' .$param3. ' at ' .$param4.'</p>
  <img id = "blog_pic" src="data:image/png;base64, '.base64_encode($param6).'" alt="Profile"/>
    <p>'.$param5.' </p>
  </div>
  <div class="comments">
  <a href="#"><img onclick="on()" src="../client/images\002-thumbs-up-hand-symbol.svg" class="candl"/></a>
    <p>Log in to view comments!</p>
  </div>
 <hr>';
}
      }

      function query_all()
            {
    include'include/connection.php';
              if(isset($_GET["type"])){
                 $type = $_GET["type"];

                if ($conn->connect_error) {
                    die("Connection failed:" . $conn->connect_error);
                }
                $sql = "     SELECT *
                             FROM blogPost
                             WHERE blogType = '$type'
                             ORDER BY blogDate DESC;";

                $result = mysqli_query($conn, $sql);
                return $result;
            }
          }

      function query_blogLikes($param7){
        include 'include/connection.php';
          if ($conn->connect_error) {
              die("Connection failed:" . $conn->connect_error);
          }
          $sql = "SELECT COUNT(likeId) AS numOfLikes FROM LikePost WHERE blogId=".$param7.";";
          $result = mysqli_query($conn, $sql);
          $count=mysqli_fetch_assoc($result);
            return $count['numOfLikes'];
      }
      function trending_posts(){
        include'include/connection.php';
          if ($conn->connect_error) {
              die("Connection failed:" . $conn->connect_error);
          }
          $sql = "SELECT blogId,userName,COUNT(*) AS numOfLikes FROM LikePost GROUP BY LikePost.blogId ORDER BY numOfLikes DESC LIMIT 8;";
          // SELECT COUNT(likeId) AS numOfLikes,blogPost.userName,blogPost.blogDate FROM LikePost,blogPost WHERE blogPost.blogId=LikePost.blogId GROUP BY blogId ORDER BY numOfLikes DESC LIMIT 8
          $result = mysqli_query($conn, $sql);
            return $result;
      }
?>

<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="utf-8">
  <title>TrapBuzz - Home</title>
  <link rel="logo icon" href="../client/images/TrapBuzz_icon.ico" />
  <link rel="stylesheet" href="../client/css/reset.css">
  <link rel="stylesheet" href="../client/css/home.css">
  <link rel="stylesheet" href="../client/css/styling1.css">
  <link rel="stylesheet" href="../client/css/Profile.css">
  <script type="text/javascript" src="../client/javascript/ajax.js"></script>
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
  <div id="main">
    <div id="main_column">
  <?php
    $result = query_all();
     $resultCheck = mysqli_num_rows($result);
     if ($resultCheck > 0) {
         while ($row = mysqli_fetch_assoc($result)) {
           $blogid = $row['blogId'];
            displayContent_blogs($row['blogTitle'], $row['userName'], date('Y-m-d', strtotime($row['blogDate'])), date('h:i a' , strtotime($row['blogDate'])), $row['blogContent'], $row['blogPic'],$row['blogId']);
         }
     }elseif($resultCheck <= 0){
     echo "<h1 style ='border-bottom: 1px solid black;'> No blogs at the moment! <br> Check back again to see if someone posts.</h1>";

   }
   ?>
    </div>
<div id="sidebar_column">
  <h1 id="Trending">Trending Posts</h1>
<?php
function displayContent_trending($param1, $param2,$param3,$param4,$param5){
echo'
      <p> <a href=hotPost-inc.php?blogId='.$param5.'&userName='.$param1.'> <img class = "hotprofilepic" src="../client/images\005-man-user.svg" alt="Profile"/> by '.$param1.' on<time datetime="'.
      $param4.'"> '.$param2.'</time> at '.$param3.' </a> </p>';
    }
    $result2 = trending_posts();
     $resultCheck2 = mysqli_num_rows($result2);
     if ($resultCheck2 > 0) {
         while ($row = mysqli_fetch_assoc($result2)) {
           $sqldate="SELECT * FROM blogPost WHERE blogId=".$row['blogId'].";";
           include'include/connection.php';
           $resultdate = mysqli_query($conn, $sqldate);
           while ($rowdate = mysqli_fetch_assoc($resultdate)){
           displayContent_trending($row['userName'],date('Y-m-d', strtotime($rowdate['blogDate'])), date('h:i a' , strtotime($rowdate['blogDate'])),$rowdate['blogDate'],$row['blogId']);
         }
       }
       }
       elseif($resultCheck <= 0){
         echo "<h4 style ='border-bottom: 1px solid black; text-align: center; color: white;'> No blogs at the moment!</h4>";
     }
?>
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
 <script type="text/javascript" src="../client/javascript/ajax.js"></script>
 <script type="text/javascript" src="../client/javascript/ajaxLikes.js"></script>
</body>


</html>
