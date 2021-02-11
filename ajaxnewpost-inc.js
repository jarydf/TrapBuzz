$(document).ready(function () {
  $("#newpost").on("submit", function (e) {
    e.preventDefault();
    var types = $("#blogpost_types").val();
    var title = $("#blogpost_title").val();
    var blog = $("#new_blog").val();

    alert("types: " + types + ", title " + title + ", blog " + blog);
    $.ajax({
      url: "newpost-inc.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function (response) {
        if (response == "success") {
          window.location.href = "Home.php";
        } else if (response == "fail") {
          alert("one of the fields isn't set properly");
        } else if (response == "fail1") {
          alert("sql statement not made correctly");
        } else if (response == "fail2") {
          alert("file error. your file is too big or it is the wrong kind of file");
        } else if (response == "") {
          alert("no response");
        } else {
          alert("image upload failure. Please use a jpg or png " + response);
        }
      },
      error: function () {
        alert("php error");
      },
    });
  });
});
