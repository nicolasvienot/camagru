// const username = document.getElementById('username');
// const email = document.getElementById('email');
const password = document.getElementById("password");
const password_check = document.getElementById("password_check");
const reset = document.getElementById("reset");
const reset_form = document.getElementById("reset_form");

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
  // reset_form.removeEventListener('keyup', handle_enter, true);
  var data = new FormData(reset_form);
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var res = JSON.parse(this.responseText);
      // if (res.result === 1) {
      //     var modal = document.getElementById('modal_good');
      //     var html = document.querySelector('html');
      //     modal.classList.add('is-active');
      //     html.classList.add('is-clipped');
      // } else {
      //     var modal = document.getElementById('modal_bad');
      //     var html = document.querySelector('html');
      //     modal.classList.add('is-active');
      //     html.classList.add('is-clipped');
      //     modal.querySelector('#close').addEventListener('click', function(e) {
      //         e.preventDefault();
      //         modal.classList.remove('is-active');
      //         html.classList.remove('is-clipped');
      //         reset_form.addEventListener('keyup', handle_enter, true);
      //     });
      //     document.getElementById("tryagain").addEventListener('click', function(e) {
      //         e.preventDefault();
      //         modal.classList.remove('is-active');
      //         html.classList.remove('is-clipped');
      //         reset_form.addEventListener('keyup', handle_enter, true);
      //     });
      // }
    }
  };
  xmlhttp.open("POST", "../../controller/users/resetpassword_action.php", true);
  xmlhttp.send(data);
});

// signup_form.addEventListener('keyup', handle_enter, true);
// function handle_enter() {
//     if (event.keyCode === 13) {
//         event.preventDefault();
//         signup.click();
//     }
// }
