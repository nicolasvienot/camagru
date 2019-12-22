<?php
    include(__DIR__ . '/../controller/templates/header.php');
?>

<div style="width: 50%; margin: auto; padding: 30px; text-align: center;">
    <div class="title is-2 is-size-4-touch">Social Wall</div>
</div>
<div class="columns is-multiline" id="col_gallery">
    <?php echo $gallery ?>
</div>
<button class="button is-loading is-centered is-fullwidth" id="loadingbutton" style="display: none;">Loading</button>
<div style="width: 50%; margin: auto; padding: 30px; text-align: center; display:none;" id="endimages">
    <div class="title is-5 is-centered">No more images to display :(</div>
</div>

<script src="../public/js/socialwall.js"></script>

<?php
    include(__DIR__ . '/../controller/templates/footer.php');
?>