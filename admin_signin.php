<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="utf-8">
  <title>Admin login</title>
  <link rel="logo icon" href="TrapBuzz_icon.ico" />
  <link rel="stylesheet" href="reset.css">
  <link rel="stylesheet" href="recovery.css">
</head>

<body>
  <header>
    <a href="signup.php" title="Sign in"> <img class = "icons" id = "logo" src="TrapBuzz.png" alt="logo"></a>
    <p>Admin login</p>
  </header>
  <div id="password_recover">
    <h1>Sign in as an admin below.</h1>
    <form  method="post" action = "admin-inc.php">
      <input id="email_recovery" name = "adminUser" type="text" placeholder="Username" required>
        <input id="email_recovery" name = "adminPass" type="password" placeholder="Password" required>
      <input name = "adminSignin" id="submit_recover" type="submit" name="admin_In" value="Sign in">
    </form>
  </div>
</body>
</html>
