const username = document.getElementById("username");
const email = document.getElementById("email");
const password = document.getElementById("new_password");
const password_check = document.getElementById("new_password_check");
const update_username = document.getElementById("update_username");
const update_email = document.getElementById("update_email");
const update_password = document.getElementById("update_password");
const button_notifications = document.getElementById("notifications");
const username_message = document.getElementById("username_message");
const email_message = document.getElementById("email_message");
const password_f_message = document.getElementById("password_f_message");

var regex_password = /^(?=.*[a-z])(?=.*[0-9])(?=.{8,})/;
var regex_email = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

if (notif == 1) {
  document.getElementById("notificationsyes").className =
    "button is-success is-selected is-disabled";
  document.getElementById("notificationsno").className = "button is-disabled";
} else {
  document.getElementById("notificationsyes").className = "button is-disabled";
  document.getElementById("notificationsno").className =
    "button is-danger is-selected is-disabled";
}

button_notifications.onclick = function(e) {
  button_notifications.disabled = true;
  e.preventDefault();
  notif === 1 ? (notif = 0) : (notif = 1);
  var data = new FormData();
  data.append("type", 4);
  data.append("user_notification", notif);
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var res = JSON.parse(this.responseText);
      button_notifications.disabled = false;
    }
  };
  xmlhttp.open("POST", "../../controller/users/modifyaccount_action.php", true);
  xmlhttp.send(data);
  if (notif == 1) {
    document.getElementById("notificationsyes").className =
      "button is-success is-selected is-disabled";
    document.getElementById("notificationsno").className = "button is-disabled";
  } else {
    document.getElementById("notificationsyes").className =
      "button is-disabled";
    document.getElementById("notificationsno").className =
      "button is-danger is-selected is-disabled";
  }
};

username.addEventListener("keyup", function() {
  if (username.value === "") {
    username.className = "input";
    document.getElementById("username_available").style.display = "none";
    document.getElementById("username_not_available").style.display = "none";
    document.getElementById("username_wrong_format").style.display = "none";
    document.getElementById("validuser").style.display = "none";
    document.getElementById("notvaliduser").style.display = "none";
  } else if (!check_valid_username(username.value)) {
    username.className = "input is-danger";
    document.getElementById("username_available").style.display = "none";
    document.getElementById("username_not_available").style.display = "none";
    document.getElementById("username_wrong_format").style.display = "block";
    document.getElementById("validuser").style.display = "none";
    document.getElementById("notvaliduser").style.display = "block";
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
          document.getElementById("username_wrong_format").style.display =
            "none";
          document.getElementById("validuser").style.display = "block";
          document.getElementById("notvaliduser").style.display = "none";
        } else {
          username.className = "input is-danger";
          document.getElementById("username_available").style.display = "none";
          document.getElementById("username_not_available").style.display =
            "block";
          document.getElementById("username_wrong_format").style.display =
            "none";
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

email.addEventListener("keyup", function() {
  if (email.value === "") {
    email.className = "input";
    document.getElementById("email_available").style.display = "none";
    document.getElementById("email_not_available").style.display = "none";
    document.getElementById("email_wrong_format").style.display = "none";
    document.getElementById("validemail").style.display = "none";
    document.getElementById("notvalidemail").style.display = "none";
  } else if (regex_email.test(email.value) == false) {
    email.className = "input is-danger";
    document.getElementById("email_available").style.display = "none";
    document.getElementById("email_not_available").style.display = "none";
    document.getElementById("email_wrong_format").style.display = "block";
    document.getElementById("validemail").style.display = "none";
    document.getElementById("notvalidemail").style.display = "block";
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var res = JSON.parse(this.responseText);
        if (res.result === 0) {
          email.className = "input is-success";
          document.getElementById("email_available").style.display = "block";
          document.getElementById("email_not_available").style.display = "none";
          document.getElementById("email_wrong_format").style.display = "none";
          document.getElementById("validemail").style.display = "block";
          document.getElementById("notvalidemail").style.display = "none";
        } else {
          email.className = "input is-danger";
          document.getElementById("email_available").style.display = "none";
          document.getElementById("email_not_available").style.display =
            "block";
          document.getElementById("email_wrong_format").style.display = "none";
          document.getElementById("validemail").style.display = "none";
          document.getElementById("notvalidemail").style.display = "block";
        }
      }
    };
    xmlhttp.open(
      "GET",
      "../../controller/users/signup_checkemail.php?email=" + email.value,
      true
    );
    xmlhttp.send();
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

update_username.addEventListener("click", function(event) {
  username_message.style.display = "none";
  if (check_valid_username(username.value) && username.value != "") {
    document.getElementById("form_username_wrong_format").style.display =
      "none";
    var data = new FormData(document.getElementById("username_form"));
    data.append("type", 1);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var res = JSON.parse(this.responseText);
        if (res.result === 1) {
          username_message.style.display = "block";
          username_message.className = "label has-text-success is-size-6";
          username_message.innerText = res.message;
          username.value = "";
          username.className = "input";
          document.getElementById("username_available").style.display = "none";
          document.getElementById("username_not_available").style.display =
            "none";
          document.getElementById("username_wrong_format").style.display =
            "none";
          document.getElementById("validuser").style.display = "none";
          document.getElementById("notvaliduser").style.display = "none";
        } else {
          username_message.style.display = "block";
          username_message.className = "label has-text-danger is-size-6";
          username_message.innerText = res.message;
          username.className = "input";
          document.getElementById("username_available").style.display = "none";
          document.getElementById("username_not_available").style.display =
            "none";
          document.getElementById("username_wrong_format").style.display =
            "none";
          document.getElementById("validuser").style.display = "none";
          document.getElementById("notvaliduser").style.display = "none";
        }
      }
    };
    xmlhttp.open(
      "POST",
      "../../controller/users/modifyaccount_action.php",
      true
    );
    xmlhttp.send(data);
  } else {
    document.getElementById("form_username_wrong_format").style.display =
      "block";
  }
});

update_email.addEventListener("click", function(event) {
  email_message.style.display = "none";
  if (email.value != "" && regex_email.test(email.value)) {
    document.getElementById("form_email_wrong_format").style.display = "none";
    var data = new FormData(document.getElementById("email_form"));
    data.append("type", 2);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var res = JSON.parse(this.responseText);
        if (res.result === 1) {
          email_message.style.display = "block";
          email_message.className = "label has-text-success is-size-6";
          email_message.innerText = res.message;
          email.value = "";
          email.className = "input";
          document.getElementById("email_available").style.display = "none";
          document.getElementById("email_not_available").style.display = "none";
          document.getElementById("email_wrong_format").style.display = "none";
          document.getElementById("validemail").style.display = "none";
          document.getElementById("notvalidemail").style.display = "none";
        } else {
          email_message.style.display = "block";
          email_message.className = "label has-text-danger is-size-6";
          email_message.innerText = res.message;
          email.className = "input";
          document.getElementById("email_available").style.display = "none";
          document.getElementById("email_not_available").style.display = "none";
          document.getElementById("email_wrong_format").style.display = "none";
          document.getElementById("validemail").style.display = "none";
          document.getElementById("notvalidemail").style.display = "none";
        }
      }
    };
    xmlhttp.open(
      "POST",
      "../../controller/users/modifyaccount_action.php",
      true
    );
    xmlhttp.send(data);
  } else {
    document.getElementById("form_email_wrong_format").style.display = "block";
  }
});

update_password.addEventListener("click", function(event) {
  if (
    password.value === password_check.value &&
    password.value != "" &&
    password_check.value != ""
  ) {
    document.getElementById("form_password_wrong_format").style.display =
      "none";
    var data = new FormData(document.getElementById("password_form"));
    data.append("type", 3);
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
      "../../controller/users/modifyaccount_action.php",
      true
    );
    xmlhttp.send(data);
  } else {
    document.getElementById("form_password_wrong_format").style.display =
      "block";
  }
});

function check_valid_username(username) {
  var code, i, len;
  if (username.length < 4 || username.length > 16) return false;
  for (i = 0, len = username.length; i < len; i++) {
    code = username.charCodeAt(i);
    if (
      !(code > 47 && code < 58) &&
      !(code > 64 && code < 91) &&
      !(code > 96 && code < 123)
    ) {
      return false;
    }
  }
  return true;
}
