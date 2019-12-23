const password = document.getElementById("password");
const password_check = document.getElementById("password_check");
const reset = document.getElementById("reset");
const reset_form = document.getElementById("reset_form");
const password_f_message = document.getElementById("password_f_message");

var regex_password = /^(?=.*[a-z])(?=.*[0-9])(?=.{8,})/;
var regex_email = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

password.addEventListener("keyup", function(event) {
  if (password.value === "") {
    password.className = "input";
    document.getElementById("password_message").style.display = "none";
  } else if (regex_password.test(password.value) == true) {
    password.className = "input is-success";
    document.getElementById("password_message").style.display = "none";
  } else {
    password.className = "input is-danger";
    document.getElementById("password_message").style.display = "block";
  }
});

password_check.addEventListener("keyup", function(event) {
  if (password_check.value === "") {
    password_check.className = "input";
    document.getElementById("password_check_message").style.display = "none";
  } else if (password_check.value === password.value) {
    password_check.className = "input is-success";
    document.getElementById("password_check_message").style.display = "none";
  } else {
    password_check.className = "input is-danger";
    document.getElementById("password_check_message").style.display = "block";
  }
});

reset.addEventListener("click", function(event) {
  password_f_message.style.display = "none";
  if (
    password.value === password_check.value &&
    password.value != "" &&
    password_check.value != ""
  ) {
    document.getElementById("form_password_wrong_format").style.display =
      "none";
    var data = new FormData(reset_form);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var res = JSON.parse(this.responseText);
        if (res.result === 1) {
          password_f_message.style.display = "block";
          password_f_message.className = "label has-text-success is-size-6";
          password_f_message.innerText = res.message;
          password.className = "input";
          document.getElementById("password_message").style.display = "none";
          password_check.className = "input";
          document.getElementById("password_check_message").style.display =
            "none";
          // reset.style.display = "none";
        } else {
          password_f_message.style.display = "block";
          password_f_message.className = "label has-text-danger is-size-6";
          password_f_message.innerText = res.message;
          password.className = "input";
          document.getElementById("password_message").style.display = "none";
          password_check.className = "input";
          document.getElementById("password_check_message").style.display =
            "none";
        }
      }
    };
    xmlhttp.open(
      "POST",
      "../../controller/users/resetpassword_action.php",
      true
    );
    xmlhttp.send(data);
  } else {
    document.getElementById("form_password_wrong_format").style.display =
      "block";
  }
});
