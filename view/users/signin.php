<?php
    include (__DIR__ . '/../../controller/templates/header.php');
?>

<div style="width: 50%; margin: auto; padding: 30px;">
    <div style="text-align: center; padding-bottom: 20px;">
        <h1 class="title is-3">We're glad to see you back!</h1> 
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
        <div class="field" id="passworddiv">
            <p class="control has-icons-left">
                <input class="input" id="password" name="password" type="password" placeholder="Password">
                <span class="icon is-small is-left">
                    <i class="fas fa-lock"></i>
                </span>
            </p>
        </div>
        <div class="field" id="login">
            <p class="control">
                <button type="button" class="button is-success" id="signin">
                Login
                </button>
            </p>
        </div>
    </form>
</div>

<script src="../../public/js/signin.js"></script>

<?php
    include (__DIR__ . '/../../controller/templates/footer.php');
?>