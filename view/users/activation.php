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
                        <strong>Success</strong>
                        <?php } else { ?>
                        <strong>Error</strong>
                        <?php } ?>
                        <br>
                        <?php echo $res->message ?>
                    </p>
                </div>
            </div>
        </article>
        <div class="buttons" style="padding-top: 10px;">
            <?php if ($res->result === 1) {?>
                <a class="button is-primary" href="/signin"><strong>Log in</strong></a>
                <a class="button is-light" href="/">Home</a>
            <?php } else { ?>
                <a class="button is-primary" href="/signup"><strong>Sign up</strong></a>
                <a class="button is-light" href="/">Home</a>
            <?php } ?>
        </div>
    </div>
</div>

<?php
    include(__DIR__ . '/../../controller/templates/footer.php');
?>