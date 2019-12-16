
function do_like(event) {
    var data = new FormData();
    data.append('img_id', event.path[0].offsetParent.children[0].children[0].id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var res = JSON.parse(this.responseText);
            if (res.result === 1) {
                event.path[0].offsetParent.children[2].children[0].children[2].children[0].classList.add('has-text-danger');
                var nblikes = parseInt(event.path[0].offsetParent.children[2].children[0].children[2].children[1].innerText) + 1;
                event.path[0].offsetParent.children[2].children[0].children[2].children[1].innerText = nblikes;
            }
            else if (res.result === 2) {
                event.path[0].offsetParent.children[2].children[0].children[2].children[0].classList.remove('has-text-danger');
                var nblikes = parseInt(event.path[0].offsetParent.children[2].children[0].children[2].children[1].innerText) - 1;
                console.log(nblikes);
                event.path[0].offsetParent.children[2].children[0].children[2].children[1].innerText = nblikes;
            }           
            else {
                console.log('Error nblikes');
            }
        }
    };
    xmlhttp.open("POST", "../controller/socialwall_likes.php", true);
    xmlhttp.send(data);
};

var imgs = document.querySelectorAll(".card-image");
imgs.forEach(element => {
    element.addEventListener('click', do_like, true);
});