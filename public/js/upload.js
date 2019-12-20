start_webcam();

var streamError;
var webcamStream;
var start = 1;
var filter = new Image();
filter.src = '../../public/img/filters/lgbt.png';
var isDraggable = false;
var interval = "";
var canvas_drag = document.getElementById("canvas2");
var button_drag = document.getElementById("movefilter");
var context_drag = canvas_drag.getContext("2d");
var currentX = canvas_drag.width/2;
var currentY = canvas_drag.height/2;
var loading = 1;
var picturetaken = 0;

function start_webcam() {
    loading = 1;
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
                loading = 0;
            };
        })
        .catch(function(err) {
            console.log("Something went wrong : " + err);
            streamError = 1;
        });
    }
}

function stop_webcam() {
    webcamStream.getTracks().forEach(function(track) {
        track.stop();
      });
}

function get_image() {
    picturetaken = 1;
    this.disabled = false;
    var webcam = document.getElementById("webcam")
    var canvas = document.getElementById("canvas");
    canvas.width = webcam.videoWidth;
    canvas.height = webcam.videoHeight;
    canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
    canvas.getContext("2d").drawImage(webcam, 0, 0, webcam.width, webcam.height, 0, 0, canvas.width, canvas.height);    
};

document.getElementById("buttontakepicture").addEventListener('click', get_image, true);

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

var imgs = document.querySelectorAll(".gallery");
imgs.forEach(element => {
    element.addEventListener('click', delete_p, true);
});

function reset_cam(event) {
    picturetaken = 0;
    var canvas = document.getElementById("canvas");
    canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
};

document.getElementById("button2").addEventListener('click', reset_cam, true);

function share() {
    if (picturetaken === 1)
    {
        var data = new FormData();
        if (document.getElementById("upload_div").style.display !== "none")
            data.append('img', document.getElementById("canvas3").toDataURL("image/png"));
        else
            data.append('img', document.getElementById("canvas").toDataURL("image/png"));
        data.append('filter', filter.getAttribute('src'));
        data.append('x', (currentX - (filter.width / 2)));
        data.append('y', (currentY - (filter.height / 2)));
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
                    column.className = "column is-one-quarter-desktop is-half-tablet gallery";
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
}

document.getElementById("buttonshare").addEventListener('click', share, true);

function handle_file(event)
{
    loading = 1;
    var files = this.files;
    if (files && files.length > 0) {
        file = files[0];
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function(e) {
            var img = new Image();
            img.onload = function() {
                var canvas = document.getElementById('canvas3');
                var context = canvas.getContext('2d');
                context.clearRect(0, 0, canvas.width, canvas.height);
                context.fillStyle = "#FFFFFF";
                context.fillRect(0, 0, canvas.width, canvas.height);
                context.drawImage(img, 0, 0);
                document.getElementById('canvas_upload').style.display = "";
                start_drag();
                loading = 0;
                picturetaken = 1;
            }
            img.src = e.target.result;
        }
    }
}

document.getElementById("inputfile").addEventListener('change', handle_file, true);

function handle_button_webcam(event) {
    if (loading == 0)
    {
        loading = 1;
        picturetaken = 0;
        upload_div = document.getElementById("upload_div");
        webcam_div = document.getElementById("webcam_div");
        webcam_div.style.display = "";
        upload_div.style.display = "none";
        document.getElementById('canvas_upload').style.display = "none";
        stop_drag();
        reset_drag();
        canvas_drag = document.getElementById("canvas2");
        context_drag = canvas_drag.getContext("2d");
        buttonupload = document.getElementById("buttonupload");
        this.className = "button is-primary is-selected";
        buttonupload.className = "button";
        start_webcam();
    }
}

document.getElementById("buttonwebcam").addEventListener('click', handle_button_webcam, true);

function handle_button_upload(event) {
    if (loading == 0)
    {
        loading = 1;
        picturetaken = 0;
        upload_div = document.getElementById("upload_div");
        webcam_div = document.getElementById("webcam_div");
        webcam_div.style.display = "none";
        upload_div.style.display = "";
        document.getElementById('canvas_upload').style.display = "none";
        stop_drag();
        reset_drag();
        stop_webcam();
        canvas_drag = document.getElementById("canvas4");
        context_drag = canvas_drag.getContext("2d");
        buttonwebcam = document.getElementById("buttonwebcam");
        this.className = "button is-primary is-selected";
        buttonwebcam.className = "button";
        loading = 0;
    }
}

document.getElementById("buttonupload").addEventListener('click', handle_button_upload, true);

button_drag.onclick = function(e) {
    (start === 1) ? start = 0 : start = 1;
    console.log(start);
    if (start == 1) {
        document.getElementById("movefilteryes").className = "button is-success is-selected is-disabled"
        document.getElementById("movefilterno").className = "button is-disabled";
        start_drag();
    }
    else {
        document.getElementById("movefilteryes").className = "button is-disabled";
        document.getElementById("movefilterno").className = "button is-danger is-selected is-disabled";
        stop_drag();
    }
}

function start_drag() {
    canvas_drag.addEventListener("mousedown", handle_mousedown, true);
    canvas_drag.addEventListener("mousemove", handle_mousemove, true);
    canvas_drag.addEventListener("mouseup", handle_mouseup, true);
    canvas_drag.addEventListener("mouseout", handle_mouseout, true);
    interval = setInterval(start_loop, 1000/30);
}

function stop_drag() {
    canvas_drag.removeEventListener("mousedown", handle_mousedown, true);
    canvas_drag.removeEventListener("mousemove", handle_mousemove, true);
    canvas_drag.removeEventListener("mouseup", handle_mouseup, true);
    canvas_drag.removeEventListener("mouseout", handle_mouseout, true);
    clearInterval(interval);
}

function start_loop() {
    console.log('yo');
    reset_canvas();
    draw_image();
}

function handle_mousedown(event) {
    var rect = canvas_drag.getBoundingClientRect();
    var mouseX = event.clientX - rect.left;
    var mouseY = event.clientY - rect.top;
    console.log(event.clientX, event.clientY);
    if (mouseX >= (currentX - filter.width / 2) && mouseX <= (currentX + filter.width / 2) && mouseY >= (currentY - filter.height / 2) && mouseY <= (currentY + filter.height / 2)) 
    {
        isDraggable = true;
    }
}

function handle_mousemove(event) {
    if (isDraggable) {
    var rect = canvas_drag.getBoundingClientRect();
    currentX = event.clientX - rect.left;
    currentY = event.clientY - rect.top;
    }
}

function handle_mouseup(event) {
    isDraggable = false;
}

function handle_mouseout(event) {
    isDraggable = false;
}

function draw_image() {
  context_drag.drawImage(filter, currentX - (filter.width / 2), currentY - (filter.height / 2));
}

function reset_canvas() {
    context_drag.fillStyle = 'rgba(0, 0, 0, 1)';
    context_drag.clearRect(0, 0, canvas_drag.width, canvas_drag.height);
}

var filters = document.querySelectorAll(".filter");
filters.forEach(element => {
    element.addEventListener("click", handle_click_filter, true);
});

function handle_click_filter(event) {
    console.log('coucou');
    filter.src = event.path[0].getAttribute('src');
    console.log(filter.src)
}

function reset_drag() {
    isDraggable = false;
    interval = "";
    currentX = canvas_drag.width/2;
    currentY = canvas_drag.height/2;
    context_drag.clearRect(0, 0, canvas_drag.width, canvas_drag.height);
}