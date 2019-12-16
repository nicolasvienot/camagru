
function do_like(event) {
    var data = new FormData();
    data.append('img_id', event.path[0].offsetParent.children[0].children[0].id);
    // console.log(event.path[0].offsetParent.children[0].children[0].id);
    var xmlhttp = new XMLHttpRequest();
    // // xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var res = JSON.parse(this.responseText);
            console.log(res.message);
            if (res.result === 1) {
                event.path[0].offsetParent.children[2].children[0].children[2].children[0].classList.add('has-text-danger');
                var nblikes = parseInt(event.path[0].offsetParent.children[2].children[0].children[2].children[1].innerText) + 1;
                console.log(nblikes);
                event.path[0].offsetParent.children[2].children[0].children[2].children[1].innerText = nblikes;
                // has-text-danger
                // console.log('Image deleted');
                // var element = document.getElementById(event.srcElement.id);
                // element.parentNode.removeChild(element);
                // var img = document.createElement('img'); 
                // img.style.height = '240px';
                // img.style.width = '320px';
                // img.src = '../' + res.img_path;
                // img.addEventListener('click', delete_pic, true);
                // document.getElementById("gallery").prepend(img);
            }
            if (res.result === 2) {
                event.path[0].offsetParent.children[2].children[0].children[2].children[0].classList.remove('has-text-danger');
                var nblikes = parseInt(event.path[0].offsetParent.children[2].children[0].children[2].children[1].innerText) - 1;
                console.log(nblikes);
                event.path[0].offsetParent.children[2].children[0].children[2].children[1].innerText = nblikes;
            }           
            else {
                console.log('Not uploaded');
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

// var likes = document.querySelectorAll('.fas fa-heart');

// // var likes = document.getElementsByClassName('.fas fa-heart');
// likes.forEach(element => {
//     element.addEventListener('click', do_like, true);
// });
