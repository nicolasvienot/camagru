const password = document.getElementById('password');
const signin = document.getElementById('signin');
const signin_form = document.getElementById('signin_form');
const send_forgot = document.getElementById('send_forgot');
const forgot_form = document.getElementById('forgot_form');
const forgot = document.getElementById('forgot');

signin.addEventListener('click', function (event) {
    var data = new FormData(signin_form);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var res = JSON.parse(this.responseText);
            if (res.result === 1) {
                console.log('Connected');
                window.location.replace("/");
            } else {
                var passworddiv = document.getElementById('passworddiv');
                var newDiv = document.createElement("div"); 
                var newContent = document.createTextNode(res.message);
                newDiv.appendChild(newContent);
                passworddiv.appendChild(newDiv);
            }
        }
    };
    xmlhttp.open("POST", "../../controller/users/signin_action.php", true);
    xmlhttp.send(data);
});

send_forgot.addEventListener('click', function (event) {
    event.preventDefault();
    var data = new FormData(forgot_form);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var res = JSON.parse(this.responseText);
            console.log(res);

            // var modal = document.getElementById('modal');
            // var html = document.querySelector('html');
            // modal.classList.remove('is-active');
            // html.classList.remove('is-clipped');

            // var modal_close = document.getElementById('modal_close');
            // var html = document.querySelector('html');
            // modal_close.classList.add('is-active');
            // html.classList.add('is-clipped');
            // modal_close.querySelector('#close').addEventListener('click', function(e) {
            //     e.preventDefault();
            //     modal_close.classList.remove('is-active');
            //     html.classList.remove('is-clipped');
            //     // signup_form.addEventListener('keyup', handle_enter, true);
            // });
            // document.getElementById("close_modal").addEventListener('click', function(e) {
            //     e.preventDefault();
            //     modal_close.classList.remove('is-active');
            //     html.classList.remove('is-clipped');
            //     // signup_form.addEventListener('keyup', handle_enter, true);
            // });
            // if (res.result === 1) {
            //     console.log('Connected');
            //     window.location.replace("/");
            // } else {
            //     var passworddiv = document.getElementById('passworddiv');
            //     var newDiv = document.createElement("div"); 
            //     var newContent = document.createTextNode(res.message);
            //     newDiv.appendChild(newContent);
            //     passworddiv.appendChild(newDiv);
            // }
        }
    };
    xmlhttp.open("POST", "../../controller/users/forgot_action.php", true);
    xmlhttp.send(data);
});

forgot.addEventListener('click', function (event) {
    var modal = document.getElementById('modal');
    var html = document.querySelector('html');
    modal.classList.add('is-active');
    html.classList.add('is-clipped');
    modal.querySelector('#close').addEventListener('click', function(e) {
        e.preventDefault();
        modal.classList.remove('is-active');
        html.classList.remove('is-clipped');
        // signup_form.addEventListener('keyup', handle_enter, true);
    });
    document.getElementById("close_modal").addEventListener('click', function(e) {
        e.preventDefault();
        modal.classList.remove('is-active');
        html.classList.remove('is-clipped');
        // signup_form.addEventListener('keyup', handle_enter, true);
    });
});

signin_form.addEventListener('keyup', function(event) {
  if (event.keyCode === 13) {
    console.log('click');
    event.preventDefault();
    signin.click();
  }
});