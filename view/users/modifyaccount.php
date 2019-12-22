<?php
    include(__DIR__ . '/../../controller/templates/header.php');
?>

<?php if ($notif === '1') {
    echo '<script>var notif = 1;</script>';
} else {
    echo '<script>var notif = 0;</script>';
} ?>

<div style="width: 50%; margin: auto; padding: 30px;">
    <div style="text-align: center; padding-bottom: 20px;">
        <h1 class="title is-3">Hi <?php echo $_SESSION['user'] ?></h1>
        <h1 class="title is-4">Modify your account</h1>
    </div>
    <div class="buttons has-addons">
        <button id="notifications" class="button">Notifications</button>
        <div id="notificationsno" class="button is-disabled" style="pointer-events: none;">No</div>
        <div id="notificationsyes" class="button is-disabled" style="pointer-events: none;">Yes</div>
    </div>
    <form id="username_form">
        <div class="field">
            <label class="label">Modify username</label>
            <div class="control has-icons-left has-icons-right">
                <input class="input" id="username" type="text" name="new_login" placeholder="jdoe">
                <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
                </span>
                <span class="icon is-small is-right">
                <i class="fas fa-check" id="validuser" style="display: none;"></i>
                <i class="fas fa-exclamation-triangle" id="notvaliduser" style="display: none;"></i>
                </span>
            </div>
            <p class="help is-success" id="username_available" style="display: none;">This username is available</p>
            <p class="help is-danger" id="username_not_available" style="display: none;">This username is not available</p>
            <p class="help is-danger" id="username_wrong_format" style="display: none;">Username must be between 4 and 16 alpha numeric characters</p>
        </div>
        <label class="label is-size-6" id="username_message" style="display: none;"></label>
        <p class="help is-danger" id="form_username_wrong_format" style="display: none;">Please check the field</p>
        <div class="field is-grouped">
            <div class="control">
                <button type="button" class="button is-primary" id="update_username">Update username</button>
            </div>
        </div>
    </form>
    <form id ="email_form">
        <div class="field">
            <label class="label">Modify email</label>
            <div class="control has-icons-left has-icons-right">
                <input class="input" id="email" type="email" name="new_email" placeholder="john@doe.com">
                <span class="icon is-small is-left">
                <i class="fas fa-envelope"></i>
                </span>
                <span class="icon is-small is-right">
                <i class="fas fa-check" id="validemail" style="display: none;"></i>
                <i class="fas fa-exclamation-triangle" id="notvalidemail" style="display: none;"></i>
                </span>
            </div>
            <p class="help is-success" id="email_available" style="display: none;">This email is available</p>
            <p class="help is-danger" id="email_not_available" style="display: none;">This email is not available</p>
            <p class="help is-danger" id="email_wrong_format" style="display: none;">This email is invalid</p>
        </div>
        <label class="label is-size-6" id="email_message" style="display: none;"></label>
        <p class="help is-danger" id="form_email_wrong_format" style="display: none;">Please check the field</p>
        <div class="field is-grouped">
            <div class="control">
                <button type="button" class="button is-primary" id="update_email">Update email</button>
            </div>
        </div>
    </form>
    <form id="password_form">
        <div class="field">
            <label class="label">Modify password</label>
            <p>Actual password</p>
            <p class="control has-icons-left">
                <input class="input" id="old_password" type="password" name="old_password" placeholder="Actual password">
                <span class="icon is-small is-left">
                    <i class="fas fa-lock"></i>
                </span>
            </p>
        </div>
        <div class="field">
            <p>New password</p>
            <p class="control has-icons-left">
                <input class="input" id="new_password" type="password" name="new_password" placeholder="New password">
                <span class="icon is-small is-left">
                    <i class="fas fa-lock"></i>
                </span>
            </p>
            <p class="help is-danger" id="password_message" style="display: none;">Password must contain at least 8 characters, one letter and one number</p>
        </div>
        <div class="field">
            <p class="control has-icons-left">
                <input class="input" id="new_password_check" type="password" name="new_password_check" placeholder="Confirm new password">
                <span class="icon is-small is-left">
                    <i class="fas fa-lock"></i>
                </span>
            </p>
            <p class="help is-danger" id="password_check_message" style="display: none;">The two passwords must match</p>
        </div>
        <label class="label is-size-6" id="password_f_message" style="display: none;"></label>
        <p class="help is-danger" id="form_password_wrong_format" style="display: none;">Please check all the fields</p>
        <div class="field is-grouped">
            <div class="control">
                <button type="button" class="button is-primary" id="update_password">Update password</button>
            </div>
        </div>
        <form>
</div>

<script src="../../public/js/modifyaccount.js"></script>


<?php
    include(__DIR__ . '/../../controller/templates/footer.php');
?>