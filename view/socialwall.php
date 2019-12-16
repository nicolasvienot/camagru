<?php
    include (__DIR__ . '/../controller/templates/header.php');
?>

<div style="width: 50%; margin: auto; padding: 30px; text-align: center;">
    <p style="padding-bottom: 5px;">Work in progress...</p>
    <br>
    <progress class="progress is-primary" max="100">30%</progress> <br/>
</div>
<div class="columns is-multiline" id="col_gallery">
<?php echo $gallery ?>
</div>

<script src="../public/js/socialwall.js"></script>

<?php
    include (__DIR__ . '/../controller/templates/footer.php');
?>