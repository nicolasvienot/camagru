const username = document.getElementById("username");
const email = document.getElementById("email");
const password = document.getElementById("password");
const password_check = document.getElementById("password_check");
const signup = document.getElementById("signup");
const signup_form = document.getElementById("signup_form");

var regex_password = /^(?=.*[a-z])(?=.*[0-9])(?=.{8,})/;
var regex_email = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

username.addEventListener("keyup", function(event) {
  if (username.value === "") {
    username.className = "input";
    document.getElementById("username_available").style.display = "none";
    document.getElementById("username_not_available").style.display = "none";
    document.getElementById("validuser").style.display = "none";
    document.getElementById("notvaliduser").style.display = "none";
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var res = JSON.parse(this.responseText);
        if (res.result === 0) {
          username.className = "input is-success";
          document.getElementById("username_available").style.display = "block";
          document.getElementById("username_not_available").style.display =
            "none";
          document.getElementById("validuser").style.display = "block";
          document.getElementById("notvaliduser").style.display = "none";
        } else {
          username.className = "input is-danger";
          document.getElementById("username_available").style.display = "none";
          document.getElementById("username_not_available").style.display =
            "block";
          document.getElementById("validuser").style.display = "none";
          document.getElementById("notvaliduser").style.display = "block";
        }
      }
    };
    xmlhttp.open(
      "GET",
      "../../controller/users/signup_checklogin.php?login=" + username.value,
      true
    );
    xmlhttp.send();
  }
});

email.addEventListener("keyup", function(event) {
  if (email.value === "") {
    email.className = "input";
    document.getElementById("validemail").style.display = "none";
    document.getElementById("notvalidemail").style.display = "none";
    document.getElementById("email_message").style.display = "none";
  } else if (regex_email.test(email.value) == true) {
    email.className = "input is-success";
    document.getElementById("validemail").style.display = "block";
    document.getElementById("notvalidemail").style.display = "none";
    document.getElementById("email_message").style.display = "none";
  } else {
    email.className = "input is-danger";
    document.getElementById("validemail").style.display = "none";
    document.getElementById("notvalidemail").style.display = "block";
    document.getElementById("email_message").style.display = "block";
  }
});

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

signup.addEventListener("click", function(event) {
  signup_form.removeEventListener("keyup", handle_enter, true);
  var data = new FormData(document.getElementById("signup_form"));
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var res = JSON.parse(this.responseText);
      if (res.result === 1) {
        var modal = document.getElementById("modal_good");
        var html = document.querySelector("html");
        modal.classList.add("is-active");
        html.classList.add("is-clipped");
      } else {
        var modal = document.getElementById("modal_bad");
        var html = document.querySelector("html");
        modal.classList.add("is-active");
        html.classList.add("is-clipped");
        modal.querySelector("#close").addEventListener("click", function(e) {
          e.preventDefault();
          modal.classList.remove("is-active");
          html.classList.remove("is-clipped");
          signup_form.addEventListener("keyup", handle_enter, true);
        });
        document
          .getElementById("tryagain")
          .addEventListener("click", function(e) {
            e.preventDefault();
            modal.classList.remove("is-active");
            html.classList.remove("is-clipped");
            signup_form.addEventListener("keyup", handle_enter, true);
          });
      }
    }
  };
  xmlhttp.open("POST", "../../controller/users/signup_action.php", true);
  xmlhttp.send(data);
});

signup_form.addEventListener("keyup", handle_enter, true);
function handle_enter() {
  if (event.keyCode === 13) {
    event.preventDefault();
    signup.click();
  }
}
