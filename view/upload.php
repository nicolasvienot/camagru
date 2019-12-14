<?php
    include (__DIR__ . '/../controller/templates/header.php');
?>
<!-- <div style="width: 50%; margin: auto; padding: 30px; text-align: center;"> -->
    <div>
        <div id="webcam_div"> 
            <div class="columns is-centered is-vcentered is-mobile">
                <div class="column is-half is-narrow has-text-centered">
                    <video id="webcam" height="480px" width="640px" autoplay>No stream available from webcam</video>
                </div>
                <div class="column is-half is-narrow has-text-centered">
                    <canvas id="canvas" height="480px" width="640px" >No stream available from webcam</canvas>
                </div>
            </div>
        </div>
        <div id="button_div"> 
            <button id="button" class="button is-info is-light">CLICK HERE TO TAKE PICTURE</button>
        </div> 
        <div id="button_div"> 
            <button id="upload" class="button is-info is-light">UPLOAD</button>
        </div>
        <h2>Gallery</h2>
        <div id="gallery">
        </div> 
    </div>
<!-- </div> -->

<script src="../../public/js/upload.js"></script>

<?php
    include (__DIR__ . '/../controller/templates/footer.php');
?>