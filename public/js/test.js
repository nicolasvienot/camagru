var canvas, context;
var filter = new Image();
filter.src = '../../public/img/filters/lgbt.png';
var isDraggable = false;
var currentX = 0;
var currentY = 0;
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

function start_loop() {
    console.log('yo');
    reset_canvas();
    draw_image();
}

function handle_mousedown(event) {
    var rect = canvas.getBoundingClientRect();
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
    var rect = canvas.getBoundingClientRect();
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
  context.drawImage(filter, currentX - (filter.width / 2), currentY - (filter.height / 2));
}

function reset_canvas() {
    context.fillStyle = 'rgba(0, 0, 0, 1)';
    context.clearRect(0, 0, canvas.width, canvas.height);
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