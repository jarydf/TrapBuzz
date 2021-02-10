$(document).ready(function () {
  $(".comment-form").on("submit", function (event) {
    event.preventDefault();
    var commentContent = $(this).find(".commentContent").val();
    $(this).find(".commentContent").val("");
    commentContent = $.trim(commentContent);
    var blogId = $(this).find(".blogId").html();
    if (commentContent == "") {
      alert("empty field");
      $(this).find(".commentContent").css("border-color", "red");
    } else {
      $(".commentContent").css("border-color", "#DCDCDC");
      $.ajax({
        url: "insertComments.php",
        method: "POST",
        data: { commentContent: "" + commentContent, blogId: "" + blogId },
        async: false,
        cache: false,
        success: function (data) {
          $(this).find(".nocomments").remove();
          load_comment();
        },
        error: function (data) {
          alert("failure");
        },
      });
    }
  });
  function load_comment() {
    for (var i = 0; i < $(".blogId").length; i++) {
      $(".output").eq(i).empty();
      var blogId = $(".blogId").eq(i).html();
      $.ajax({
        url: "getComments.php",
        method: "POST",
        data: { blogId: blogId },
        async: false,
        cache: false,
        success: function (data) {
          $(".output").eq(i).append(data);
        },
        error: function (data) {
          alert("failure to load");
        },
      });
    }
  }
  load_comment();
});
