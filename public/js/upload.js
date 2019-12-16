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
            console.log("Something went wrong : " + err);
            streamError = 1;
        });
    }
}

function share() {
    var data = new FormData();
    data.append('img', document.getElementById("canvas").toDataURL("image/png"));
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var res = JSON.parse(this.responseText);
            if (res.result === 1) {
                var column = document.createElement('div');
                var card = document.createElement('div');
                var figure = document.createElement('figure');
                var img = document.createElement('img');
                column.className = "column is-one-quarter-desktop is-half-tablet";
                card.className = "card-image";
                figure.className = "image has-ratio";
                img.style.height = '240px';
                img.style.width = '320px';
                column.id = res.img_id;
                img.src = '../' + res.img_path;
                figure.appendChild(img);
                card.appendChild(figure);
                column.appendChild(card);  
                column.addEventListener('click', delete_p, true);
                document.getElementById("gallery").prepend(column);
            } else {
                console.log('Error : not uploaded');
            }
        }
    };
    xmlhttp.open("POST", "../controller/upload_pic.php", true);
    xmlhttp.send(data);
}

document.getElementById("upload").addEventListener('click', share, true);

function getPicture() {
    var button = document.getElementById("button");
    var webcam = document.getElementById("webcam")
    var canvas = document.getElementById("canvas");
    button.disabled = false;
    
    button.onclick = function() {
        canvas.getContext("2d").drawImage(webcam, 0, 0, 640, 480);
    };
}

function delete_p(event) {
    if (confirm('Are you sure you want to delete this image?')) {
        var data = new FormData();
        data.append('img_id', event.path[3].id);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var res = JSON.parse(this.responseText);
                if (res.result === 1) {
                    console.log('Image deleted');
                    var element = document.getElementById(event.path[3].id);
                    element.parentNode.removeChild(element);
                } else {
                    console.log('Error : image not deleted');
                }
            }
        };
        xmlhttp.open("POST", "../controller/delete_pic.php", true);
        xmlhttp.send(data);
    }
};

var imgs = document.querySelectorAll(".is-one-quarter-desktop");
imgs.forEach(element => {
    element.addEventListener('click', delete_p, true);
});