<?php
    include(__DIR__ . '/../../controller/templates/header.php');
?>

<div style="width: 50%; margin: auto; padding: 30px;">
    <div style="text-align: center; padding-bottom: 20px;">
        <h1 class="title is-size-4-touch">We're glad to see you back!</h1> 
    </div>
    <form id="signin_form" onsubmit="return false">
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
                <p class="help is-danger" id="form_wrong_format" style="display: none;"></p>
                <div class="buttons">
                    <button type="button" class="button is-success" id="signin">Login</button>
                    <button type="button" class="button is-success is-light is-small" id="forgot">Forgot account?</button>
                </div>
            </p>
        </div>
    </form>
    <div class="modal" id="modal">
        <div class="modal-background"></div>
        <div class="modal-content">
            <div class="box">
                <form id="forgot_form" onsubmit="return false">
                    <label class="title is-4">Reset password</label>
                    <br>
                    <br>
                    <label class="label">Your email address</label>
                    <div class="field">
                        <div class="control has-icons-left has-icons-right">
                            <input class="input" id="email" type="email" name="email_forgot" placeholder="john@doe.com">
                            <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </div>
                    </div>
                    <label class="label is-size-6" id="forgot_message" style="display: none;"></label>
                    <div class="buttons">
                        <div class="button is-primary" id="send_forgot">Send</div>
                        <div class="button is-primary" id="close_modal">Close</div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-close is-large" aria-label="close" id="close"></div>
    </div>
    <div class="modal" id="modal_close">
        <div class="modal-background"></div>
            <div class="modal-content">
                <div class="box">
                <div class="buttons">
                    <div class="button is-primary" id="close_modal">Close</div>
                </div>
            </div>
        </div>
        <div class="modal-close is-large" aria-label="close" id="close"></div>
    </div>
</div>

<script src="../../public/js/signin.js"></script>

<?php
    include(__DIR__ . '/../../controller/templates/footer.php');
?>