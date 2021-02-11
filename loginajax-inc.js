$(document).ready(function () {
  $("#sign_in").submit(function (e) {
    e.preventDefault();
    var username = $("#login_username").val();
    var password = $("#login_password").val();

    if ($.trim(username) == "" && $.trim(password) == "") {
    } else if ($.trim(username) == "") {
      $("#login_username").css("border-color", "red");
      $("#login_errormessage").show();
      $("#login_errormessage").text("username empty");
    } else if ($.trim(password) == "") {
      $("login_password").css("border-color", "red");
      $("#login_errormessage").show();
      $("#login_errormessage").text("password empty");
    } else if ($.trim(password).length < 4) {
      $("#login_errormessage").show();
      $("#login_errormessage").text("password isn't long enough");
      $("login_password").css("border-color", "red");
    } else {
      $.ajax({
        url: "login-inc.php",
        type: "POST",
        data: { exist_userid: username, exist_pwd: password },
        success: function (response) {
          if (response == "success") {
            window.location.href = "Home.php";
          } else if (response == "fail") {
            $("#login_errormessage").show();
            $("#login_errormessage").text("username or password is wrong");
            $("#login_username").val("");
            $("#login_password").val("");
          } else if (response == "fail1") {
            $("#login_errormessage").show();
            $("#login_errormessage").text("password doesn't match");
            $("#login_username").val("");
            $("#login_password").val("");
          } else if (response == "fail2") {
            $("#login_errormessage").show();
            $("#login_errormessage").text("nothing set in array");
            $("#login_username").val("");
            $("#login_password").val("");
          } else {
            alert("Something went wrong please try again...");
          }
        },
        error: function () {
          alert("Something went wrong please try again...");
        },
      });
    }
  });
});
