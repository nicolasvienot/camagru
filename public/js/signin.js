const password = document.getElementById("password");
const signin = document.getElementById("signin");
const signin_form = document.getElementById("signin_form");
const send_forgot = document.getElementById("send_forgot");
const forgot_form = document.getElementById("forgot_form");
const forgot = document.getElementById("forgot");
const form_message = document.getElementById("form_wrong_format");
const forgot_message = document.getElementById("forgot_message");

signin.addEventListener("click", function(event) {
  var data = new FormData(signin_form);
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var res = JSON.parse(this.responseText);
      if (res.result === 1) {
        form_message.style = "none";
        window.location.replace("/");
      } else {
        form_message.style = "block";
        form_message.innerText = res.message;
      }
    }
  };
  xmlhttp.open("POST", "../../controller/users/signin_action.php", true);
  xmlhttp.send(data);
});

send_forgot.addEventListener("click", function(event) {
  forgot_message.style.display = "none";
  event.preventDefault();
  var data = new FormData(forgot_form);
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var res = JSON.parse(this.responseText);
      forgot_message.style.display = "block";
      forgot_message.className = "label has-text-success is-size-6";
      forgot_message.innerText = res.message;
      send_forgot.style.display = "none";
    } else {
      forgot_message.style.display = "block";
      forgot_message.className = "label has-text-danger is-size-6";
      forgot_message.innerText = res.message;
    }
  };
  xmlhttp.open("POST", "../../controller/users/forgot_action.php", true);
  xmlhttp.send(data);
});

forgot.addEventListener("click", function(event) {
  send_forgot.style.display = "block";
  var modal = document.getElementById("modal");
  var html = document.querySelector("html");
  modal.classList.add("is-active");
  html.classList.add("is-clipped");
  modal.querySelector("#close").addEventListener("click", function(e) {
    e.preventDefault();
    modal.classList.remove("is-active");
    html.classList.remove("is-clipped");
  });
  document.getElementById("close_modal").addEventListener("click", function(e) {
    e.preventDefault();
    modal.classList.remove("is-active");
    html.classList.remove("is-clipped");
  });
});

signin_form.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
    event.preventDefault();
    signin.click();
  }
});
