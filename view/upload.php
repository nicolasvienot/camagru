<?php
    include (__DIR__ . '/../controller/templates/header.php');
?>

<!-- <div style="margin: auto; padding: 30px; text-align: center;"> -->
<div id="webcam_div" style="is-centered"> 
    <div id="button_div" class="buttons has-addons is-centered">
        <button id="button3" class="button is-primary is-selected">WEBCAM</button>
        <button id="button4" class="button">UPLOAD IMAGE</button>
    </div>            
    <figure class="image container has-ratio" id="drag" style="max-width: 640px;">
        <video id="webcam" height="480px" width="640px" autoplay>No stream available from webcam</video>
        <canvas id="canvas" height="480px" width="640px" style="top: 0; right: 0; bottom: 0; left: 0; position: absolute; width: 100%; height: 100%;">No stream available from webcam</canvas>
        <canvas id="canvas2" height="480px" width="640px" style="top: 0; right: 0; bottom: 0; left: 0; position: absolute; width: 100%; height: 100%;">No stream available from webcam</canvas>
    </figure>
    <br>
    <div id="button_div2" class="buttons has-addons is-centered">
        <button id="button2" class="button is-danger">RESET</button>
        <button id="button" class="button is-success">TAKE PICTURE</button>
    </div>
</div>
<br>
<div class="buttons has-addons is-centered">
  <button id="movefilter" class="button">Move filter</button>
  <button id="movefilterno" class="button is-danger is-selected is-disabled">No</button>
  <button id="movefilteryes" class="button is-disabled">Yes</button>
</div>
<br>
<div class="buttons has-addons is-centered">
<button id="buttonshare" class="button is-success">SHARE</button>
<button id="buttonhome" class="button is-light is-info">HOME</button>
</div>
<br>
<br>

<br>
<br>
<br>
        
        <!-- <form action="<?php //echo 'lol' ?>" enctype="multipart/form-data" method="post" id="uploadpic">
            <label class="file-label is-size-6 has">
            <input class="file-input" id="fileToUpload" name="fileToUpload" type="file">
            <span class="file-cta">
                <span class="file-icon">
                <i class="fas fa-upload"></i>
                </span>
                <span class="file-label">
                or choose a pic...
                </span>
            </span>
            </label> 
            <button class="button is-link is-size-6 has" style="background-color:#C3A239; position:relative; top:5px; display:none;" type="submit" value="Upload Image" name="submit" id="Upload Image">...and upload it !</button>
            <input name="add_filter" id='add_filter' type="hidden">
        </form> -->

<br>
<div style="margin: auto; padding: 30px; text-align: center;">
    <h2 class="title is-size-5">My gallery</h2>
    <div class="columns is-multiline" id="gallery">
            <?php echo $gallery ?>
    </div>
</div>
<!-- </div> -->
<!-- </div> -->

<script src="../../public/js/test.js"></script>
<script src="../../public/js/upload.js"></script>


<?php
    include (__DIR__ . '/../controller/templates/footer.php');
?>