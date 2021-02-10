<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="utf-8">
    <title>TrapBuzz. Your words online.</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="logo icon" href="TrapBuzz_icon.ico" />
    <link rel="stylesheet" href="signup.css">
    <script type="text/javascript" src="dropdown.js"></script>
    <script type="text/javascript" src="validation.js?n=1"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="jquery-3.1.1.min.js"></script>
</head>

<body>
    <div>
        <div id="left_side">
            <h1 class="left_text"> Write. <h1>
                    <h1 class="left_text"> Share. <h1>
                            <h1 class="left_text"> Grow. <h1>
        </div>
        <div id="right_side">
            <form id="sign_in" name="signin" method="post" action="login-inc.php">
                <p id="top_right"> Sign in here: </p>
                <input class="signin_input" type="text" name="exist_userid" placeholder="Username" id="login_username">
                <input class="signin_input" type="password" name="exist_pwd" placeholder="Password" id="login_password">
                <input id="submit_1" type="submit" name="signin" value="Log in">
                <br>
                <span id="login_errormessage" class="alert alert-danger" role="alert" style="display:none"></span>
                <a id="recovery_link" href="recovery.php"> Forgot password?</a>
                <a id="recovery_link" href="admin_signin.php"> Are you an admin? Log in here.</a>
            </form>
            <section id="main_right">
                <img class="icons" id="logo" src="TrapBuzz.png" alt="logo">
                <h1>Express yourself online</h1>
                <h3>Join TrapBuzz today.</h3>
                <form id="sign_up" name="signup" method="post" action="signup-inc.php"
                    onsubmit="return validateSignUp()">
                    <input class="signup_input1" type="text" name="Fname" placeholder="First name">
                    <input class="signup_input1" type="text" name="Lname" placeholder="Last name">
                    <br />
                    <?php if (isset($name_error)): ?>
                    <script>
                    document.forms["signup"]["userid"].style.borderColor = "red";
                    </script>
                    <?php endif ?>
                    <input class="signup_input2" type="email" name="useremail" placeholder="Email">
                    <input class="signup_input2" type="password" name="userpwd" placeholder="Password">
                    <input class="signup_input2" type="password" name="re_userpwd" placeholder="Confirm password">
                    <input id="submit_2" type="submit" name="submit_Signup" value="Sign me up!">
                </form>
            </section>
            <p id="sneak"> Sneak in with minimum accessibility? <a href="Home.php"> Enter</a> </p>
        </div>
    </div>
    <footer>
        <em>Copyright &copy; 2018 TRAPBUZZ - ALL RIGHTS RESERVED</em>
    </footer>
    <script type="text/javascript" src="loginajax-inc.js"></script>
</body>

</html>