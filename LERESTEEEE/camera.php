<?php
    include ('check_session.php');
    include ('header.php');
?>

<div>
    <div id="webcam_div"> 
        <video id="webcam" height="480px" width="640px" autoplay>No stream available from webcam</video>
        <canvas id="canvas" height="480px" width="640px" >No stream available from webcam</canvas>
    </div>
    <div id="button_div"> 
        <button id="button" class="button is-info is-light">CLICK HERE TO TAKE PICTURE</button>
    </div> 
</div>

<script>
    getCamera();
    getPicture();

    function getCamera() {
        var vplay = document.getElementById("webcam_div");
        vplay.setAttribute('style', 'width:auto');

        var webcam = document.querySelector("#webcam"), webcamStream, ctx;
        var canvas = document.querySelector("#canvas");
        var streamError = 0;

        if (navigator.mediaDevices.getUserMedia) {        
            navigator.mediaDevices.getUserMedia({video: { width: 640, height: 480 }})
            .then(function(stream) {
                webcam.srcObject = stream;
                // webcamStream = stream;
            })
            .catch(function(err) {
                console.log("Something went wrong!\n" + err);
                streamError = 1;
            });
        }
    }

    // function init() {
    //     var canvas = document.getElementById("canvas");
    //     if (streamError && streamError === 1) {
    //         // console.log("LOL");
    //         canvas.style.width = document.getElementById("webcam").offsetWidth + "px";
    //         canvas.style.height = document.getElementById("webcam").offsetHeight + "px";
    //     }
    //     else if (streamError === 0) {
    //         // console.log(document.getElementById("webcam").offsetWidth + "px");
    //         canvas.style.width ='100%';
    //         canvas.style.height='100%';
    //         canvas.width  = canvas.offsetWidth;
    //         canvas.height = canvas.offsetHeight;
    //         // canvas.width  = window.innerWidth;
    //         // canvas.height  = window.innerWidth;
    //         // canvas.style.width = '100%';
    //         // canvas.style.height = 'auto';
    //     }
    //     ctx = canvas.getContext('2d');
    // }

    function getPicture() {
        var button = document.getElementById("button");
        var webcam = document.getElementById("webcam")
        var canvas = document.getElementById("canvas");
        button.disabled = false;

        button.onclick = function() {
            console.log(canvas.width);
            console.log(canvas.height);
            canvas.getContext("2d").drawImage(webcam, 0, 0, 640, 480);
            // var img = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
            window.location.href=img;
		};
    }

</script>

<?php
    include 'footer.php';
?>