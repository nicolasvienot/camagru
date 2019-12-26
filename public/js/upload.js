var streamError;
var webcamStream;
var start = 0;
var upload = 0;
var filter = new Image();
var audio_shutter = new Audio("../../public/mp3/shutter.wav");
var audio_congrats = new Audio("../../public/mp3/congratulations.wav");
filter.src = "../../public/img/filters/lgbt.png";
var isDraggable = false;
var interval = "";
var canvas_drag = document.getElementById("canvas2");
var button_drag = document.getElementById("movefilter");
var context_drag = canvas_drag.getContext("2d");
var currentX = canvas_drag.width / 2;
var currentY = canvas_drag.height / 2;
var loading = 1;
var picturetaken = 0;

function start_webcam() {
  loading = 1;
  var vplay = document.getElementById("webcam_div");
  vplay.setAttribute("style", "width:auto");
  if (!navigator.mediaDevices) {
    if (streamError !== 1)
      document.getElementById("canvas_webcam").innerHTML +=
        '<p style="text-align:center;">No webcam found</p>';
    if (start !== 0) {
      document.getElementById("movefilteryes").className = "button is-disabled";
      document.getElementById("movefilterno").className =
        "button is-danger is-selected is-disabled";
      stop_drag();
    }
    start = 0;
    loading = 0;
    streamError = 1;
    console.log("Something went wrong, likely to be https connection");
  } else if (navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices
      .getUserMedia({ video: { width: 640, height: 480 } })
      .then(function(stream) {
        var webcam = document.querySelector("#webcam");
        webcam.srcObject = stream;
        webcamStream = stream;
        streamError = 0;
        webcam.onloadeddata = function() {
          if (start !== 1) {
            document.getElementById("movefilteryes").className =
              "button is-success is-selected is-disabled";
            document.getElementById("movefilterno").className =
              "button is-disabled";
            start_drag();
          }
          start = 1;
          loading = 0;
        };
      })
      .catch(function(err) {
        if (start !== 0) {
          document.getElementById("movefilteryes").className =
            "button is-disabled";
          document.getElementById("movefilterno").className =
            "button is-danger is-selected is-disabled";
          stop_drag();
        }
        if (streamError !== 1)
          document.getElementById("canvas_webcam").innerHTML +=
            '<p style="text-align:center;">No webcam found</p>';
        streamError = 1;
        console.log("Something went wrong : " + err);
        start = 0;
        loading = 0;
      });
  }
}

function stop_webcam() {
  webcamStream.getTracks().forEach(function(track) {
    track.stop();
  });
}

function get_image() {
  if (picturetaken == 0 && streamError !== 1) {
    this.disabled = false;
    if (audio_shutter) audio_shutter.play();
    var webcam = document.getElementById("webcam");
    var canvas = document.getElementById("canvas");
    canvas.width = webcam.videoWidth;
    canvas.height = webcam.videoHeight;
    canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);
    canvas
      .getContext("2d")
      .drawImage(
        webcam,
        0,
        0,
        webcam.width,
        webcam.height,
        0,
        0,
        canvas.width,
        canvas.height
      );
    picturetaken = 1;
  }
}

document
  .getElementById("buttontakepicture")
  .addEventListener("click", get_image, true);

function delete_p(event) {
  if (confirm("Are you sure you want to delete this image?")) {
    var data = new FormData();
    var img_id = event.currentTarget.id;
    data.append("img_id", img_id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var res = JSON.parse(this.responseText);
        if (res.result === 1) {
          var element = document.getElementById(img_id);
          element.parentNode.removeChild(element);
        } else {
          console.log("Error : image not deleted");
        }
      }
    };
    xmlhttp.open("POST", "../controller/delete_pic.php", true);
    xmlhttp.send(data);
  }
}

var imgs = document.querySelectorAll(".delete_p");
imgs.forEach(element => {
  element.addEventListener("click", delete_p, false);
});

function reset_cam(event) {
  if (picturetaken === 1) {
    picturetaken = 0;
    var canvas = document.getElementById("canvas");
    canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);
  }
}

document.getElementById("button2").addEventListener("click", reset_cam, true);

function share() {
  if (picturetaken === 1 && loading !== 1) {
    var data = new FormData();
    if (document.getElementById("upload_div").style.display !== "none")
      data.append(
        "img",
        document.getElementById("canvas3").toDataURL("image/png")
      );
    else
      data.append(
        "img",
        document.getElementById("canvas").toDataURL("image/png")
      );
    data.append("filter", filter.getAttribute("src"));
    data.append("x", currentX - filter.width / 2);
    data.append("y", currentY - filter.height / 2);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var res = JSON.parse(this.responseText);
        if (res.result === 1) {
          var column = document.createElement("div");
          var card = document.createElement("div");
          var figure = document.createElement("figure");
          var img = document.createElement("img");
          var divoverlay = document.createElement("div");
          var divdelete = document.createElement("div");
          divoverlay.className = "overlay-gallery";
          divdelete.className = "text";
          divdelete.innerText = "Delete image";
          column.className =
            "delete_p column is-one-quarter-desktop is-half-tablet gallery";
          card.className = "card-image container-gallery";
          figure.className = "image has-ratio";
          column.id = res.img_id;
          img.src = "../" + res.img_path;
          divoverlay.appendChild(divdelete);
          figure.appendChild(img);
          figure.appendChild(divoverlay);
          card.appendChild(figure);
          column.appendChild(card);
          column.addEventListener("click", delete_p, false);
          document.getElementById("gallery").prepend(column);
          if (audio_congrats) audio_congrats.play();
        } else {
          console.log("Error : not uploaded");
        }
      }
    };
    xmlhttp.open("POST", "../controller/upload_pic.php", true);
    xmlhttp.send(data);
  }
}

document.getElementById("buttonshare").addEventListener("click", share, true);

function handle_file(event) {
  loading = 1;
  var files = this.files;
  if (files && files.length > 0) {
    file = files[0];
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function(e) {
      var img = new Image();
      img.onload = function() {
        var canvas = document.getElementById("canvas3");
        var context = canvas.getContext("2d");
        context.clearRect(0, 0, canvas.width, canvas.height);
        context.fillStyle = "#FFFFFF";
        context.fillRect(0, 0, canvas.width, canvas.height);
        var h_ratio = canvas.width / img.width;
        var v_ratio = canvas.height / img.height;
        h_ratio < v_ratio ? (ratio = h_ratio) : (ratio = v_ratio);
        var final_width = img.width * ratio;
        var final_height = img.height * ratio;
        var left = canvas.width / 2 - final_width / 2;
        var top = canvas.height / 2 - final_height / 2;
        context.drawImage(
          img,
          0,
          0,
          img.width,
          img.height,
          left,
          top,
          final_width,
          final_height
        );
        document.getElementById("canvas_upload").style.display = "";
        if (start !== 1) {
          document.getElementById("movefilteryes").className =
            "button is-success is-selected is-disabled";
          document.getElementById("movefilterno").className =
            "button is-disabled";
          start_drag();
        }
        start = 1;
        document.getElementById("inputfile").value = "";

        loading = 0;
        picturetaken = 1;
      };
      img.src = e.target.result;
    };
  }
}

document
  .getElementById("inputfile")
  .addEventListener("change", handle_file, true);

function handle_button_webcam(event) {
  if (loading == 0) {
    loading = 1;
    upload = 0;
    picturetaken = 0;
    document
      .getElementById("canvas3")
      .getContext("2d")
      .clearRect(0, 0, canvas.width, canvas.height);
    upload_div = document.getElementById("upload_div");
    webcam_div = document.getElementById("webcam_div");
    webcam_div.style.display = "";
    upload_div.style.display = "none";
    document.getElementById("canvas_upload").style.display = "none";
    stop_drag();
    reset_drag();
    canvas_drag = document.getElementById("canvas2");
    context_drag = canvas_drag.getContext("2d");
    streamError = 0;
    buttonupload = document.getElementById("buttonupload");
    this.className = "button is-primary is-selected";
    buttonupload.className = "button";
    start_webcam();
  }
}

document
  .getElementById("buttonwebcam")
  .addEventListener("click", handle_button_webcam, true);

function handle_button_upload(event) {
  if (loading == 0) {
    loading = 1;
    picturetaken = 0;
    if (streamError === 0) {
      document
        .getElementById("canvas")
        .getContext("2d")
        .clearRect(0, 0, canvas.width, canvas.height);
      stop_webcam();
    }
    upload_div = document.getElementById("upload_div");
    webcam_div = document.getElementById("webcam_div");
    webcam_div.style.display = "none";
    upload_div.style.display = "";
    document.getElementById("canvas_upload").style.display = "none";
    stop_drag();
    reset_drag();
    canvas_drag = document.getElementById("canvas4");
    context_drag = canvas_drag.getContext("2d");
    buttonwebcam = document.getElementById("buttonwebcam");
    this.className = "button is-primary is-selected";
    buttonwebcam.className = "button";
    upload = 1;
    loading = 0;
  }
}

document
  .getElementById("buttonupload")
  .addEventListener("click", handle_button_upload, true);

button_drag.onclick = function(e) {
  if ((streamError === 0 || upload === 1) && loading === 0) {
    start === 1 ? (start = 0) : (start = 1);
    if (start === 1) {
      document.getElementById("movefilteryes").className =
        "button is-success is-selected is-disabled";
      document.getElementById("movefilterno").className = "button is-disabled";
      start_drag();
    } else {
      document.getElementById("movefilteryes").className = "button is-disabled";
      document.getElementById("movefilterno").className =
        "button is-danger is-selected is-disabled";
      stop_drag();
    }
  }
};

function start_drag() {
  canvas_drag.addEventListener("mousedown", handle_mousedown, true);
  canvas_drag.addEventListener("mousemove", handle_mousemove, true);
  canvas_drag.addEventListener("mouseup", handle_mouseup, true);
  canvas_drag.addEventListener("mouseout", handle_mouseout, true);
  interval = setInterval(start_loop, 1000 / 30);
}

function stop_drag() {
  canvas_drag.removeEventListener("mousedown", handle_mousedown, true);
  canvas_drag.removeEventListener("mousemove", handle_mousemove, true);
  canvas_drag.removeEventListener("mouseup", handle_mouseup, true);
  canvas_drag.removeEventListener("mouseout", handle_mouseout, true);
  clearInterval(interval);
}

function start_loop() {
  reset_canvas();
  draw_image();
}

function handle_mousedown(event) {
  var ratio_w = canvas_drag.offsetWidth / canvas_drag.width;
  var ratio_h = canvas_drag.offsetHeight / canvas_drag.height;
  var rect_c = canvas_drag.getBoundingClientRect();
  var mouseX = (event.clientX - rect_c.left) / ratio_w;
  var mouseY = (event.clientY - rect_c.top) / ratio_h;
  var filter_width = filter.width * ratio_w;
  var filter_height = filter.height * ratio_h;
  filter_width = filter.width;
  filter_height = filter.height;
  if (
    mouseX >= currentX - filter_width / 2 &&
    mouseX <= currentX + filter_width / 2 &&
    mouseY >= currentY - filter_height / 2 &&
    mouseY <= currentY + filter_height / 2
  ) {
    isDraggable = true;
  }
}

function handle_mousemove(event) {
  if (isDraggable) {
    var ratio_w = canvas_drag.offsetWidth / canvas_drag.width;
    var ratio_h = canvas_drag.offsetHeight / canvas_drag.height;
    var rect = canvas_drag.getBoundingClientRect();
    currentX = (event.clientX - rect.left) / ratio_h;
    currentY = (event.clientY - rect.top) / ratio_w;
  }
}

function handle_mouseup(event) {
  isDraggable = false;
}

function handle_mouseout(event) {
  isDraggable = false;
}

function draw_image() {
  context_drag.drawImage(
    filter,
    currentX - filter.width / 2,
    currentY - filter.height / 2
  );
}

function reset_canvas() {
  context_drag.fillStyle = "rgba(0, 0, 0, 1)";
  context_drag.clearRect(0, 0, canvas_drag.width, canvas_drag.height);
}

var filters = document.querySelectorAll(".filter");
filters.forEach(element => {
  element.addEventListener("click", handle_click_filter, true);
});

function handle_click_filter(event) {
  if (start === 1) filter.src = event.path[0].getAttribute("src");
  else {
    filter.onload = function() {
      context_drag.clearRect(0, 0, canvas_drag.width, canvas_drag.height);
      draw_image();
    };
    filter.src = event.path[0].getAttribute("src");
  }
}

function reset_drag() {
  isDraggable = false;
  interval = "";
  currentX = canvas_drag.width / 2;
  currentY = canvas_drag.height / 2;
  context_drag.clearRect(0, 0, canvas_drag.width, canvas_drag.height);
}

window.onload = function() {
  start_webcam();
};
