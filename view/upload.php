<?php
    include(__DIR__ . '/../controller/templates/header.php');
?>

<style>

.overlay-gallery {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  height: 100%;
  width: 100%;
  opacity: 0;
  transition: .5s ease;
  background-color: #F44F52;
  cursor: pointer;
}

.container-gallery:hover .overlay-gallery {
  opacity: 1;
}

.text {
  color: white;
  font-size: 20px;
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  text-align: center;
  cursor: pointer;
}

</style>

<div id="buttonswebcamupload" class="buttons has-addons is-centered">
    <button id="buttonwebcam" class="button is-primary is-selected">WEBCAM</button>
    <button id="buttonupload" class="button">UPLOAD IMAGE</button>
</div>            

<div id="webcam_div" class="is-centered"> 
    <figure class="image container has-ratio" id="canvas_webcam" style="max-width: 640px;">
        <video id="webcam" height="480px" width="640px" autoplay>No stream available from webcam</video>
        <canvas id="canvas" height="480px" width="640px" style="top: 0; right: 0; bottom: 0; left: 0; position: absolute; width: 100%; height: 100%;">No stream available from webcam</canvas>
        <canvas id="canvas2" height="480px" width="640px" style="top: 0; right: 0; bottom: 0; left: 0; position: absolute; width: 100%; height: 100%;">No stream available from webcam</canvas>
    </figure>
    <br>
    <div id="button_div2" class="buttons has-addons is-centered">
        <button id="button2" class="button is-danger">CLEAR PICTURE</button>
        <button id="buttontakepicture" class="button is-success">TAKE PICTURE</button>
    </div>
</div>
<div id="upload_div" class="is-centered" style="display:none;"> 
    <div class="buttons is-centered">
        <form enctype="multipart/form-data" method="post" id="uploadpic">
            <label class="file-label is-size-6">
                <input class="file-input" id="inputfile" name="buttonfile" type="file" accept="image/*">
                <span class="file-cta">
                    <span class="file-icon"><i class="fas fa-upload"></i></span>
                    <span class="file-label">Choose file...</span>
                </span>
            </label>
        </form>
    </div>
    <div id="upload_div2" class="is-centered"> 
        <figure class="image container has-ratio" id="canvas_upload" style="max-width: 640px; display:none;">
            <canvas id="canvas3" height="480px" width="640px" style="top: 0; right: 0; bottom: 0; left: 0; width: 100%;">No stream available from webcam</canvas>
            <canvas id="canvas4" height="480px" width="640px" style="top: 0; right: 0; bottom: 0; left: 0; position: absolute; width: 100%; height: 100%;">No stream available from webcam</canvas>
        </figure>
        <br>
    </div>
</div>
<br>
<div class="buttons has-addons is-centered">
  <button id="movefilter" class="button">Move filter</button>
  <button id="movefilterno" class="button is-danger is-selected is-disabled" style="pointer-events: none;">No</button>
  <button id="movefilteryes" class="button is-disabled" style="pointer-events: none;">Yes</button>
</div>
<br>
<div class="columns is-multiline is-centered" id="col">
        <div class="column is-one-third-desktop is-third-tablet is-vcentered">
            <div class="card-image">
                <figure class="image has-ratio">
                    <img class="filter" style="height:50px; width:auto; display: block; margin-left: auto; margin-right: auto;" src="../../public/img/filters/lgbt.png">
                </figure>
            </div>
        </div>
        <div class="column is-one-third-desktop is-third-tablet is-vcentered">
            <div class="card-image">
                <figure class="image has-ratio">
                    <img class="filter" style="height:50px; width:auto; display: block; margin-left: auto; margin-right: auto;" src="../../public/img/filters/yamaha.png">
                </figure>
            </div>
        </div>
        <div class="column is-one-third-desktop is-third-tablet is-vcentered">
            <div class="card-image">
                <figure class="image has-ratio">
                    <img class="filter" style="height:50px; width:auto; display: block; margin-left: auto; margin-right: auto;" src="../../public/img/filters/christmas.png">
                </figure>
            </div>
        </div>
    </label>
</div>

<br>
<div class="buttons has-addons is-centered">
    <button id="buttonshare" class="button is-success">SHARE</button>
    <a href="/">
        <button id="buttonhome" href="/" class="button is-light is-info">HOME</button>
    </a>
</div>
<br>
<div style="margin: auto; padding: 30px; text-align: center;">
    <h2 class="title is-size-5">My gallery</h2>
    <div class="columns is-multiline" id="gallery">
            <?php echo $gallery ?>
    </div>
</div>

<script src="../../public/js/upload.js"></script>


<?php
    include(__DIR__ . '/../controller/templates/footer.php');
?>