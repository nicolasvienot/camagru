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

function share() {
    var data = new FormData();
    data.append('img', document.getElementById("canvas").toDataURL("image/png"));
    var xmlhttp = new XMLHttpRequest();
    // xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            var res = JSON.parse(this.responseText);
            if (res.result === 1) {
                console.log('Uploaded');
                var img = document.createElement('img'); 
                img.src = res.img_path;
                img.style.height = '120px';
                img.style.width = '160px';
                document.getElementById("gallery").appendChild(img);
            } else {
                console.log('Not uploaded');
            }
        }
    };
    xmlhttp.open("POST", "../controller/upload_pic.php", true);
    xmlhttp.send(data);
};

document.getElementById("upload").addEventListener('click', handle_upload, true);

function handle_upload() {
    share();
}

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
        // window.location.href=img;
    };
}



