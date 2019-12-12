<?php
    include ('header.php');
?>

<div style="width: 50%; margin: auto; padding: 30px;">
    <div style="text-align: center; padding-bottom: 20px;">
        <h1 class="title is-3">We're glad to see you're back!</h1> 
    </div>
    <form id="signin_form">
        <div class="field">
            <p class="control has-icons-left">
                <input class="input" id="username" name="username" placeholder="Username">
                <span class="icon is-small is-left">
                    <i class="fas fa-user"></i>
                </span>
            </p>
        </div>
        <div class="field">
            <p class="control has-icons-left">
                <input class="input" id="password" name="password" type="password" placeholder="Password">
                <span class="icon is-small is-left">
                    <i class="fas fa-lock"></i>
                </span>
            </p>
        </div>
        <div class="field">
            <p class="control">
                <button type="button" class="button is-success" id="signin">
                Login
                </button>
            </p>
        </div>
    </form>
</div>

<script>
    const password = document.getElementById('password');
    const signin = document.getElementById('signin');

    signin.addEventListener('click', function (event) {
        var data = new FormData(document.getElementById("signin_form"));
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                if (this.responseText === "goodjob") {
                    // var modal = document.getElementById('modal_good');
                    // var html = document.querySelector('html');
                    // modal.classList.add('is-active');
                    // html.classList.add('is-clipped');
                    // modal.querySelector('#close').addEventListener('click', function(e) {
                    //     e.preventDefault();
                    //     modal.classList.remove('is-active');
                    //     html.classList.remove('is-clipped');
                    // });
                } else {
                    // var modal = document.getElementById('modal_bad');
                    // var html = document.querySelector('html');
                    // modal.classList.add('is-active');
                    // html.classList.add('is-clipped');
                    // modal.querySelector('#close').addEventListener('click', function(e) {
                    //     e.preventDefault();
                    //     modal.classList.remove('is-active');
                    //     html.classList.remove('is-clipped');
                    // });
                }
            }
        };
        xmlhttp.open("POST", "signin.php", true);
        xmlhttp.send(data);
    });

</script>

<?php
    include 'footer.php';
?>