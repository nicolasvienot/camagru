<?php
    include (__DIR__ . '/../controller/templates/header.php');
?>
<!-- <div style="width: 50%; margin: auto; padding: 30px; text-align: center;"> -->
    <div>
        <div id="webcam_div"> 
            <div class="columns is-centered is-vcentered is-mobile">
                <div class="column is-half is-narrow has-text-centered" style="border-style: solid; border-width: 5px;">
                    <video id="webcam" height="480px" width="640px" autoplay>No stream available from webcam</video>
                    <div id="button_div" class="buttons is-centered"> 
                        <button id="button" class="button is-info is-light">CLICK HERE TO TAKE PICTURE</button>
                        <button id="button2" class="button is-info is-light">UPLOAD YOUR OWN PICTURE</button>
                    </div>
                </div>
                <div class="column is-half is-narrow has-text-centered" style="border-style: solid; border-width: 5px;">
                    <canvas id="canvas" height="480px" width="640px" >No stream available from webcam</canvas>
                    <div id="button_div"> 
                        <button id="upload" class="button is-info is-light is-centered">UPLOAD</button>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        
        <form action="<?php echo 'lol' ?>" enctype="multipart/form-data" method="post" id="uploadpic">
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
        </form>

        <br>
        <h2 class="title is-size-5">My gallery</h2>

        <div class="columns is-multiline" id="gallery">
                <?php echo $gallery ?>
        </div>
    </div>
<!-- </div> -->

<script src="../../public/js/upload.js"></script>

<?php
    include (__DIR__ . '/../controller/templates/footer.php');
?>