<?php
    include (__DIR__ . '/../controller/templates/header.php');
?>

<div style="width: 50%; margin: auto; padding: 30px; text-align: center;">
    <div class="title is-2">Social Wall</div>
</div>
<div class="columns is-multiline" id="col_gallery">
    <?php echo $gallery ?>
</div>
<button class="button is-loading is-centered is-fullwidth" id="loadingbutton" style="display: none;">Loading</button>
<script src="../public/js/socialwall.js"></script>

<?php
    include (__DIR__ . '/../controller/templates/footer.php');
?>