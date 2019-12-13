<?php
    include (__DIR__ . '/../../controller/templates/header.php');
?>

<div style="width: 50%; margin: auto; padding: 30px;">
    <div class="box">
        <article class="media">
            <div class="media-left">
                <figure class="image is-64x64">
                <img src="https://bulma.io/images/placeholders/128x128.png" alt="Image">
                </figure>
            </div>
            <div class="media-content">
                <div class="content">
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
            <div class="buttons">
                <?php if ($res->result === 1) {?>
                    <a class="button is-primary" href="/signin"><strong>Log in</strong></a>
                    <a class="button is-light" href="/">Home</a>
                <?php } else { ?>
                    <a class="button is-primary" href="/signup"><strong>Sign up</strong></a>
                    <a class="button is-light" href="/">Home</a>
                <?php } ?>
            </div>
        </article>
    </div>
</div>

<?php
    include (__DIR__ . '/../../controller/templates/footer.php');
?>