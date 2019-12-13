const password = document.getElementById('password');
const signin = document.getElementById('signin');

signin.addEventListener('click', function (event) {
    var data = new FormData(document.getElementById("signin_form"));
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