//document.getElementById("password_conf").addEventListener("change", Validate_Password(password_i, password_c));

function Validate_Input(username, password_i, password_c, email) {
  // To validate email
  var format = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

  if ((username.value == "") ||
        (password_i.value == "") ||
        (password_c.value == "") ||
        (email.value == "")) {
    alert("Please do not leave a blank.");
    return false;
  }

  if (email.value.match(format)) {
    // document.signup.email.focus();
    return true;
  }
  else {
    alert("You have entered an invalid email address!");
    document.signup.email.focus();
    return false;
  }
}

function Validate_Password(password_i, password_c) {
  if (password_c.value != password_i.value) {
      document.getElementById("pass_conf_error").innerHTML = "Password does not match!";
  }
  else {
      document.getElementById("pass_conf_error").innerHTML = "";
  }
}
