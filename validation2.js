window.onload = function() {
  document.getElementById('sign_up').addEventListener('submit', function(event) {
    var required = document.getElementsByClassName("signup_input1");
    if (required[0].value == "" || required[0].value == null) {
      event.preventDefault();
    }
    if (required[1].value == "" || required[1].value == null) {

      event.preventDefault();
    }
  });

  document.getElementById('sign_up').addEventListener('submit', function(event) {
    var required = document.getElementsByClassName("signup_input2");
    if (required[0].value == "" || required[0].value == null) {
      event.preventDefault();
    }
    if (required[1].value == "" || required[1].value == null) {

      event.preventDefault();
    }
    if (required[2].value == "" || required[2].value == null) {

      event.preventDefault();
    }
  });


  var blankfield = document.getElementsByClassName("signup_input1");

  function notext(event) {
    if (event.value == "" || event.value == null || isNaN(event.value) == false)
      event.style.borderColor = "red";
    else
      event.style.borderColor = "green";
  }
  blankfield[0].addEventListener('input', function() {
    notext(blankfield[0]);
  });
  blankfield[1].addEventListener('input', function() {
    notext(blankfield[1]);
  });

}