<?php
    include(__DIR__ . '/../../controller/templates/header.php');
?>

<div style="width: 50%; margin: auto; padding: 30px;">
    <div class="box">
        <article class="media">
            <div class="media-content">
                <div class="content is-mobile">
                    <p>
                        <?php if ($res->result === 1) {?>
                        <strong>Welcome</strong>
                        <?php } else { ?>
                        <strong>Error</strong>
                        <?php } ?>
                        <br>
                        <?php echo $res->message ?>
                        <?php if ($res->result === 1) {?>
                            <form id="reset_form">
                                <div class="field">
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
                                <input class="input" id="reset_key" name="reset_key" type ="hidden" value="<?php echo $reset_key ?>">
                            </form>
                            <p class="help is-danger" id="form_password_wrong_format" style="display: none;">Please check all the fields</p>
                            <label class="label is-size-6" id="password_f_message" style="display: none;"></label>
                            <div class="field is-grouped">
                                <div class="control">
                                    <button type="button" class="button is-primary" id="reset">Reset</button>
                                </div>
                            </div>
                        <?php } ?>
                    </p>
                </div>
            </div>
        </article>
        <div class="buttons" style="padding-top: 10px;">
            <?php if ($res->result === 1) {?>
                <a class="button is-light" href="/">Home</a>
            <?php } else { ?>
                <a class="button is-primary" href="/signup"><strong>Sign up</strong></a>
                <a class="button is-light" href="/">Home</a>
            <?php } ?>
        </div>
    </div>
</div>


<!-- CAREFUL -->
<script src="../../public/js/resetpassword.js"></script>

<?php
    include(__DIR__ . '/../../controller/templates/footer.php');
?>