function validateSignUp() {
  var fname = document.forms["signup"]["Fname"].value;
  if (fname == "" || fname.trim() == "") {
    document.forms["signup"]["Fname"].style.borderColor = "red";
    return false;
  } else if (isNaN(fname) == false) {
    document.forms["signup"]["Fname"].style.borderColor = "red";
    document.getElementsByName('Fname')[0].value = '';
    document.getElementsByName('Fname')[0].placeholder = 'Please enter a valid name';
    return false
  }
  var lname = document.forms["signup"]["Lname"].value;
  if (lname == "" || lname.trim() == "") {
    document.forms["signup"]["Lname"].style.borderColor = "red";
    return false;
  } else if (isNaN(lname) == false) {
    document.forms["signup"]["Lname"].style.borderColor = "red";
    document.getElementsByName('Lname')[0].value = '';
    document.getElementsByName('Lname')[0].placeholder = 'Please enter a valid name';
    return false
  }

  var userName = document.forms["signup"]["userid"].value;
  if (userName == "" || userName.trim() == "") {
    document.forms["signup"]["userid"].style.borderColor = "red";
    return false;
  }
  var userEmail = document.forms["signup"]["useremail"].value;
  if (userEmail == "") {
    document.forms["signup"]["useremail"].style.borderColor = "red";
    return false;
  }

  var pwd = document.forms["signup"]["userpwd"].value;
  if (pwd == "" || pwd.trim() == "") {
    document.forms["signup"]["userpwd"].style.borderColor = "red";
    return false;
  } else if (pwd.length < 4) {
    document.forms["signup"]["userpwd"].style.borderColor = "red";
    document.getElementsByName('userpwd')[0].value = '';
    document.getElementsByName('userpwd')[0].placeholder = 'Password must be atleast length 4';
    return false;

  }
  var repwd = document.forms["signup"]["re_userpwd"].value;
  if (repwd == "" || repwd.trim() == "") {
    document.forms["signup"]["re_userpwd"].style.borderColor = "red";
    return false;
  } else if (repwd != pwd) {
    document.forms["signup"]["re_userpwd"].style.borderColor = "red";
    document.getElementsByName('re_userpwd')[0].value = '';
    document.getElementsByName('re_userpwd')[0].placeholder = 'Passwords did not match!';
    return false;

  }

}

function validateSearch() {
  var search = document.forms["header_search"]["searchbtn"].value;
  if (search == "" || search.trim() == "") {
    return false;
  }
}