$(document).ready(function () {
    function resetfields(){
        $("#signup_firstname").css("border-color", "#DCDCDC");
        $("#signup_lastname").css("border-color", "#DCDCDC");
        $("#signup_username").css("border-color", "#DCDCDC");
        $("#signup_email").css("border-color", "#DCDCDC");
        $("#signup_password").css("border-color", "#DCDCDC");
        $("#signup_confirmpassword").css("border-color", "#DCDCDC");
    }
  $("#sign_up").submit(function (e) {
    e.preventDefault();
    resetfields();
    var username = $("#signup_username").val();
    var password = $("#signup_password").val();
    var confirmpassword = $("#signup_confirmpassword").val();
    var firstname = $("#signup_firstname").val();
    var lastname = $("#signup_lastname").val();
    var email = $("#signup_email").val();
    
    if (
      $.trim(username) == "" ||
      $.trim(password) == "" ||
      $.trim(confirmpassword) == "" ||
      $.trim(firstname) == "" ||
      $.trim(lastname) == "" ||
      $.trim(email) == ""
    ) {
      if ($.trim(firstname) == "") {
        $("#signup_firstname").css("border-color", "red");
        $("#signup_errormessage").show();
        $("#signup_errormessage").text("first name empty");
      } else if ($.trim(lastname) == "") {
        $("#signup_lastname").css("border-color", "red");
        $("#signup_errormessage").show();
        $("#signup_errormessage").text("lastname empty");
      } else if ($.trim(username) == "") {
        $("#signup_username").css("border-color", "red");
        $("#signup_errormessage").show();
        $("#signup_errormessage").text("username field is empty");
      } else if ($.trim(email) == "") {
        $("#signup_email").css("border-color", "red");
        $("#signup_errormessage").show();
        $("#signup_errormessage").text("email empty");
      } else if ($.trim(password) == "") {
        $("#signup_password").css("border-color", "red");
        $("#signup_errormessage").show();
        $("#signup_errormessage").text("password empty");
      } else if ($.trim(confirmpassword) == "") {
        $("#signup_confirmpassword").css("border-color", "red");
        $("#signup_errormessage").show();
        $("#signup_errormessage").text("confirm password empty");
      } else {
        $("#signup_errormessage").show();
        $("#signup_errormessage").text("There is an empty field!");
      }
    } else if ($.trim(password).length < 4) {
      $("#signup_errormessage").show();
      $("#signup_errormessage").text("password isn't long enough");
      $("#signup_password").css("border-color", "red");
    } else if (password != confirmpassword) {
      $("#signup_errormessage").show();
      $("#signup_errormessage").text("passwords dont match");
      $("#signup_password").css("border-color", "red");
    } else {
      $.ajax({
        url: "signup-inc.php",
        type: "POST",
        data: {
          Fname: firstname,
          Lname: lastname,
          userid: username,
          useremail: email,
          userpwd: password,
        },
        success: function (response) {
          if (response == "success") {
            window.location.href = "newuser-inc.php";
          } else if (response == "fail") {
            $("#signup_errormessage").show();
            $("#signup_errormessage").text("username is taken");
            $("#signup_username").val("");
            $("#signup_password").val("");
            $("#signup_confirmpassword").val("");
            $("#signup_email").val("");
            $("#signup_firstname").val("");
            $("#signup_lastname").val("");
          } else if (response == "fail1") {
            $("#signup_errormessage").show();
            $("#signup_errormessage").text("fields are empty");
            $("#signup_username").val("");
            $("#signup_password").val("");
            $("#signup_confirmpassword").val("");
            $("#signup_email").val("");
            $("#signup_firstname").val("");
            $("#signup_lastname").val("");
          } else if (response == "fail2") {
            $("#signup_errormessage").show();
            $("#signup_errormessage").text("fields were not set");
            $("#signup_username").val("");
            $("#signup_password").val("");
            $("#signup_confirmpassword").val("");
            $("#signup_email").val("");
            $("#signup_firstname").val("");
            $("#signup_lastname").val("");
          } else {
            $("#signup_errormessage").show();
            $("#signup_errormessage").text("Something went wrong please try again...");
            $("#signup_username").val("");
            $("#signup_password").val("");
            $("#signup_confirmpassword").val("");
            $("#signup_email").val("");
            $("#signup_firstname").val("");
            $("#signup_lastname").val("");
            alert(" " + response)
          }
        },
        error: function () {
          alert("Something went wrong please try again...");
        },
      });
    }
  });
});
