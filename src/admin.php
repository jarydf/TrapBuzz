<?php
session_start();
if(isset($_SESSION['a_id'])){
   $aid = $_SESSION['a_id'];


 date_default_timezone_set('Canada/Pacific');

 // this function takes in  title, id,  date, content and picture($param6) and dislpays it
 function displayContent_blogs($param1, $param2, $param3, $param4, $param5, $param6, $blogid){
   if(isset($_SESSION['u_id'])){
   $id = $_SESSION['u_id'];
 }
   echo'<div class="post">
   <form method = "post" action = "include/admin-delete.php">
 <input id = "submitComment" type="submit" name="delete_blog" value="Delete This Post">
  <input type="hidden" name= "blog_id" value='.$blogid.'>

 </form>
     <h3 style = " border-bottom: 1px solid black;" id = "blog_title">'.$param1.'</h3>
     <p>  <img class = "profilepic" src="../client/images\005-man-user.svg" alt="Profile"/>by ' .$param2. ' on ' .$param3. ' at ' .$param4.'</p>
    <img id = "blog_pic" src="data:image/png;base64, '.base64_encode($param6).'" alt="Profile"/>         <p>'.$param5.' </p>
   </div>
   <hr>';
      }


   function query_all()
         {
           include 'include/connection.php';
             if ($conn->connect_error) {
                 die("Connection failed:" . $conn->connect_error);
             }
             $sql = "     SELECT *
                          FROM blogPost
                          ORDER BY blogDate DESC;";
             $result = mysqli_query($conn, $sql);
             return $result;
         }

         function query_search($search){
           include'include/connection.php';
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
         function query_allbytype()
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
   <script type="text/javascript" src="../client/javascript/dropdown.js"></script>
   <script type="text/javascript" src="../client/javascript/validation.js"></script>
   <script type="text/javascript" src="../client/javascript/Profile.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
   <script src = "../client/javascript/jquery-3.1.1.min.js"></script>
 </head>
 <body>
   <header>
     <a href="admin.php" title="Home"> <img class = "icons" id = "logo" src="../client/images/TrapBuzz.png" alt="logo"></a>
     <form method="get" name="header_search" action="admin.php" onsubmit="return validateSearch()">
       <input id="search" type="search" name="searchbtn" placeholder="Search">
       <input id="submit_search" type="submit" name="submit_search1" value="Search">
     </form>
     <nav>
       <ul>
         <li> <?php if(isset($_SESSION['a_id'])){ echo "Logged in: ". $aid; }
           ?> </li>
         <li><a href="admin.php"> <img class = "icons" src="../client/images\006-home-page.svg" title="Home" alt="Home"/></a></li>

         <div class="dropdown">
           <img onclick="myFunction()" class="dropbtn" title="Menu" src="../client/images/menu.svg">
           <div id="myDropdown" class="dropdown-content">

             <?php if (isset($_SESSION['a_id'])){
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
       </ul>
     </nav>
   </header>
   <div id="main">
     <div id="main_column">
       <?php


       if (isset($_GET["searchbtn"])) {
            $search = $_GET["searchbtn"];
            $result = query_search($search);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck == 0) {
                echo "<em style = 'color:white;'>No blog post matched your search <b>'" .$search. "'</b> </em>";
            } elseif ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  displayContent_blogs($row['blogTitle'], $row['userName'], date('Y-m-d', strtotime($row['blogDate'])), date('h:i a' , strtotime($row['blogDate'])), $row['blogContent'], $row['blogPic'],$row['blogId']);

                }
            }
        }

elseif (isset($_GET["type"])) {
  $result = query_allbytype();
  $resultCheck = mysqli_num_rows($result);
  if ($resultCheck > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $blogid = $row['blogId'];
         displayContent_blogs($row['blogTitle'], $row['userName'], date('Y-m-d', strtotime($row['blogDate'])), date('h:i a' , strtotime($row['blogDate'])), $row['blogContent'], $row['blogPic'],$row['blogId']);
      }
  }elseif($resultCheck <= 0){
  echo "<h1 style ='border-bottom: 1px solid black;'> No user has posted a blog of this type.</h1>";

}
}

     else{


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
     }
        ?>
     </div>
 <div id="sidebar_column">

       <h1 id="Trending">Categories</h1>
       <h2><a href = "admin.php?type=Entertainment">Entertainment<a></h2>
       <h2><a href = "admin.php?type=Technology">Technology<a></h2>
       <h2><a href = "admin.php?type=Sports">Sports<a></h2>
       <h2><a href = "admin.php?type=Travel">Travel<a></h2>
       <h2><a href = "admin.php?type=Music">Music<a></h2>
       <h2><a href = "admin.php?type=Other">Other<a></h2>

     </div>
   </div>

   <div id="overlay" onclick="off()">
   <div id="text">Oops! You're not logged in.</div>
  </div>

 </body>


 </html>
<?php
}
else {
    header("Location: signup.php");
}
?>
