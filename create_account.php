<?php
    include ('header.php');
?>

<div style="width: 50%; margin: auto; padding: 30px;">
    <div style="text-align: center; padding-bottom: 20px;">
        <h1 class="title is-3">Sign up to join the community!</h1>
    </div>
    <form id="signup_form">
        <div class="field">
            <label class="label">Username</label>
            <div class="control has-icons-left has-icons-right">
                <input class="input" id="username" type="text" name="login" placeholder="jdoe">
                <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
                </span>
                <span class="icon is-small is-right">
                <i class="fas fa-check"></i>
                </span>
            </div>
            <p class="help is-success" id="username_available" style="display: none;">This username is available</p>
            <p class="help is-danger" id="username_not_available" style="display: none;">This username is not available</p>
        </div>
        <div class="field">
            <label class="label">Email</label>
            <div class="control has-icons-left has-icons-right">
                <input class="input" id="email" type="email" name="email" placeholder="john@doe.com">
                <span class="icon is-small is-left">
                <i class="fas fa-envelope"></i>
                </span>
                <span class="icon is-small is-right">
                <i class="fas fa-exclamation-triangle"></i>
                </span>
            </div>
            <p class="help is-danger" id="email_message" style="display: none;">This email is invalid</p>
        </div>
        <div class="field">
            <label class="label">Password</label>
            <p class="control has-icons-left">
                <input class="input" id="password" type="password" name="password" placeholder="Password">
                <span class="icon is-small is-left">
                    <i class="fas fa-lock"></i>
                </span>
            </p>
            <p class="help is-danger" id="password_message" style="display: none;">Password must contain at least 8 characters, one letter and one number</p>
        </div>
        <div>
            <p class="control has-icons-left">
                <input class="input" id="password_check" type="password" name="password_check" placeholder="Confirm password">
                <span class="icon is-small is-left">
                    <i class="fas fa-lock"></i>
                </span>
            </p>
            <p class="help is-danger" id="password_check_message" style="display: none;">The two passwords must match</p>
        </div>
        <div class="field" style="margin-top: 10px;">
            <div class="control">
                <label class="checkbox">
                <input type="checkbox" name="terms">
                I agree to the <a href="#">terms and conditions</a>
                </label>
            </div>
        </div>
        <div class="field is-grouped">
            <div class="control">
                <button type="button" class="button is-primary" id="signup">Sign up</button>
            </div>
            <div class="control">
            <a href="<?php echo 'index.php' ?>"><button class="button is-primary is-light">Cancel</button></a>
            </div>
        </div>
    </form>
    <div class="modal" id="modal_good">
        <div class="modal-background"></div>
        <div class="modal-content">
            <div class="box">
                <label class="label">Congratulation, your account has been created!</label>
                <label class="label">Check your mailbox to activate it.</label>
                <a href="<?php echo 'index.php' ?>"><button class="button is-success">Go to home page</button></a>
            </div>
        </div>
        <!-- <button class="modal-close is-large" aria-label="close" id="close"></button> -->
    </div>
    <div class="modal" id="modal_bad">
        <div class="modal-background"></div>
        <div class="modal-content">
            <div class="box">
                <label class="label">It looks like there was an error!</label>
                <label class="label">Please try again.</label>
                <a href="<?php echo 'create_account.php' ?>"><button class="button is-primary">Try again</button></a>
            </div>
        </div>
        <button class="modal-close is-large" aria-label="close" id="close"></button>
    </div>
</div>

<script>
    const username = document.getElementById('username');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const password_check = document.getElementById('password_check');
    const signup = document.getElementById('signup');

    var regex_password = /^(?=.*[a-z])(?=.*[0-9])(?=.{8,})/;
    var regex_email = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    username.addEventListener('keyup', function (event) {
        if (username.value === "") {
            username.className = "input";
            document.getElementById("username_available").style.display = "none";
            document.getElementById("username_not_available").style.display = "none";
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText === "true") {
                        username.className = "input is-success";
                        document.getElementById("username_available").style.display = "block";
                        document.getElementById("username_not_available").style.display = "none";
                    } else {
                        username.className = "input is-danger";
                        document.getElementById("username_available").style.display = "none";
                        document.getElementById("username_not_available").style.display = "block";
                    }
                }
            };
            xmlhttp.open("GET", "loginexists.php?login=" + username.value, true);
            xmlhttp.send();
        }
    });

    email.addEventListener('keyup', function (event) {
        if (email.value === "") {
            email.className = "input";
            document.getElementById("email_message").style.display = "none";
        } else if (regex_email.test(email.value) == true) {
            email.className = "input is-success";
            document.getElementById("email_message").style.display = "none";
        } else {
            email.className = "input is-danger";
            document.getElementById("email_message").style.display = "block";
        }
    });

    password.addEventListener('keyup', function (event) {
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

    password_check.addEventListener('keyup', function (event) {
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

    signup.addEventListener('click', function (event) {
        var data = new FormData(document.getElementById("signup_form"));
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                if (this.responseText === "goodjob") {
                    var modal = document.getElementById('modal_good');
                    var html = document.querySelector('html');
                    modal.classList.add('is-active');
                    html.classList.add('is-clipped');
                    // modal.querySelector('#close').addEventListener('click', function(e) {
                    //     e.preventDefault();
                    //     modal.classList.remove('is-active');
                    //     html.classList.remove('is-clipped');
                    // });
                } else {
                    var modal = document.getElementById('modal_bad');
                    var html = document.querySelector('html');
                    modal.classList.add('is-active');
                    html.classList.add('is-clipped');
                    modal.querySelector('#close').addEventListener('click', function(e) {
                        e.preventDefault();
                        modal.classList.remove('is-active');
                        html.classList.remove('is-clipped');
                    });
                }
            }
        };
        xmlhttp.open("POST", "signup.php", true);
        xmlhttp.send(data);
    });

</script>

<?php
    include 'footer.php';
?>