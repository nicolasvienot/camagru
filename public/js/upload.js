start_webcam();
getPicture();

var streamError;
var webcamStream;
var start = 0;
function start_webcam() {
    var vplay = document.getElementById("webcam_div");
    vplay.setAttribute('style', 'width:auto');
    
    if (navigator.mediaDevices.getUserMedia) {        
        navigator.mediaDevices.getUserMedia({video: { width: 640, height: 480 }})
        .then(function(stream) {
            var webcam = document.querySelector("#webcam");
            webcam.srcObject = stream;
            webcamStream = stream;
            streamError = 0;
            webcam.onloadeddata = function() {
                start = 1;
                document.getElementById("movefilteryes").className = "button is-success is-selected is-disabled"
                document.getElementById("movefilterno").className = "button is-disabled";
                start_drag();
            };
        })
        .catch(function(err) {
            console.log("Something went wrong : " + err);
            streamError = 1;
        });
    }
}

function stop_webcam() {
    webcamStream.stop();
}

function getPicture() {
    var button = document.getElementById("button");
    button.disabled = false;
    button.onclick = function() {
        var webcam = document.getElementById("webcam")
        var canvas = document.getElementById("canvas");
        console.log(webcam.videoWidth);
        console.log(webcam.videoHeight);
        // console.log(webcam.offsetWidth);
        // console.log(webcam.offsetHeight);
        

        canvas.width = webcam.videoWidth;
        canvas.height = webcam.videoHeight;
        canvas.getContext("2d").drawImage(webcam, 0, 0, webcam.width, webcam.height, 0, 0, canvas.width, canvas.height);    
    }
};

// function getFilter() {
//     const canvas2 = document.getElementById("canvas2");
//     canvas2.width = webcam.videoWidth;
//     canvas2.height = webcam.videoHeight;
//     console.log(webcam.videoWidth);
//     console.log(webcam.videoHeight);
    
//     const context2 = canvas2.getContext("2d");
//     var drawing = new Image();
//     drawing.src = "http://localhost:8080/public/img/soleil.png";
//     drawing.onload = function() {
//         context2.drawImage(drawing, 0, 0, drawing.width, drawing.height, 0, 0, 100, 100);
//     };
// };

// function takePhoto()
// { 
//     const img = img || document.querySelector('img');

//     imageCapture.takePhoto()
//     .then(blob => {
//         let url = window.URL.createObjectURL(blob);
//         img.src = url;
//         window.URL.revokeObjectURL(url); 
//     })
//     .catch(error);
// }; 

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

function reset_cam(event) {
    var canvas = document.getElementById("canvas");
    canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
};

document.getElementById("button2").addEventListener('click', reset_cam, true);

// function handleResize() {
//     var w = window.innerWidth-2; // -2 accounts for the border
//     var h = window.innerHeight-2;
//     stage.canvas.width = w;
//     stage.canvas.height = h;
//     //
//     var ratio = 100/100; // 100 is the width and height of the circle content.
//     var windowRatio = w/h;
//     var scale = w/100;
//     if (windowRatio > ratio) {
//         scale = h/100;
//     }
//     // Scale up to fit width or height
//     c.scaleX= c.scaleY = scale; 
    
//     // Center the shape
//     c.x = w / 2;
//     c.y = h / 2;
        
//     stage.update();
// }
       
// handleResize();


function share() {
    var data = new FormData();
    data.append('img', document.getElementById("canvas").toDataURL("image/png"));
    data.append('x', (currentX - (star_img.width / 2)));
    data.append('y', (currentY - (star_img.height / 2)));

    console.log(currentX - (star_img.width / 2));
    console.log(currentY - (star_img.height / 2));
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var res = JSON.parse(this.responseText);
            console.log(res);
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

document.getElementById("buttonshare").addEventListener('click', share, true);