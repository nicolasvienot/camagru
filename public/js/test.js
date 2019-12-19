var canvas, context;
var star_img = new Image();
var isDraggable = false;
var currentX = 0;
var currentY = 0;
// var start = 0;
var interval = "";
canvas = document.getElementById("canvas2");
button = document.getElementById("movefilter");
context = canvas.getContext("2d");
currentX = canvas.width/2;
currentY = canvas.height/2;

button.onclick = function(e) {
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

star_img.src = '../../public/img/filters/lgbt.png';
// star_img.src='data:image/png;base64,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';

function start_drag() {
    canvas.addEventListener("mousedown", handle_mousedown, true);
    canvas.addEventListener("mousemove", handle_mousemove, true);
    canvas.addEventListener("mouseup", handle_mouseup, true);
    canvas.addEventListener("mouseout", handle_mouseout, true);
    interval = setInterval(start_loop, 1000/30);
}

function stop_drag() {
    canvas.removeEventListener("mousedown", handle_mousedown, true);
    canvas.removeEventListener("mousemove", handle_mousemove, true);
    canvas.removeEventListener("mouseup", handle_mouseup, true);
    canvas.removeEventListener("mouseout", handle_mouseout, true);
    clearInterval(interval);
}

// window.addEventListener("resize", handle_resize, true);

// function handle_resize()
// {
//     stop_drag();
//     start_drag();
// }

function start_loop() {
    reset_canvas();
    draw_image();
}

function handle_mousedown(event) {
    var rect = canvas.getBoundingClientRect();
    // console.log(rect.top, rect.right, rect.bottom, rect.left);
    // var mouseX = event.pageX - this.offsetLeft - 225;
    // var mouseY = event.pageY - this.offsetTop - 290;
    var mouseX = event.pageX - rect.left;
    var mouseY = event.pageY - rect.top;
    if (mouseX >= (currentX - star_img.width/2) && mouseX <= (currentX + star_img.width/2) && mouseY >= (currentY - star_img.height/2) && mouseY <= (currentY + star_img.height/2)) 
    {
        isDraggable = true;
    }
}

function handle_mousemove(event) {
    if (isDraggable) {
    var rect = canvas.getBoundingClientRect();
    // console.log(rect.top, rect.right, rect.bottom, rect.left);
    // currentX = event.pageX - this.offsetLeft - 225;
    // currentY = event.pageY - this.offsetTop - 290;
    currentX = event.pageX - rect.left;
    currentY = event.pageY - rect.top;
    }
}

function handle_mouseup(event) {
    isDraggable = false;
}

function handle_mouseout(event) {
    isDraggable = false;
}

function draw_image() {
  context.drawImage(star_img, currentX - (star_img.width / 2), currentY - (star_img.height / 2));
}

function reset_canvas() {
    context.fillStyle = 'rgba(0, 0, 0, 1)';
    context.clearRect(0, 0, canvas.width, canvas.height);
}