function do_like(event) {
    var data = new FormData();
    console.log(event.path[1].children[0].children[0].id);
    data.append('img_id', event.path[1].children[0].children[0].id);
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

function push_comments(event) {
    var data = new FormData();
    console.log(document.getElementById("img_container").children[0].id);
    data.append('img_id', document.getElementById("img_container").children[0].id);
    data.append('comment_content', document.getElementById("comment_content").value);

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var res = JSON.parse(this.responseText);
            if (res.result === 1) {
                
                // event.path[0].offsetParent.children[2].children[0].children[2].children[0].classList.add('has-text-danger');
                // var nblikes = parseInt(event.path[0].offsetParent.children[2].children[0].children[2].children[1].innerText) + 1;
                // event.path[0].offsetParent.children[2].children[0].children[2].children[1].innerText = nblikes;
            }         
            else {
                console.log('Error push comment');
            }
        }
    };
    xmlhttp.open("POST", "../controller/comment_add.php", true);
    xmlhttp.send(data);
};

var submit_comment = document.getElementById("submit_comment");
submit_comment.addEventListener('click', push_comments, true);

function delete_comments(event) {
    var data = new FormData();
    data.append('comment_id', event.path[2].id);

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var res = JSON.parse(this.responseText);
            console.log(res);
            if (res.result === 1) {
                
                // event.path[0].offsetParent.children[2].children[0].children[2].children[0].classList.add('has-text-danger');
                // var nblikes = parseInt(event.path[0].offsetParent.children[2].children[0].children[2].children[1].innerText) + 1;
                // event.path[0].offsetParent.children[2].children[0].children[2].children[1].innerText = nblikes;
            }         
            else {
                console.log('Error push comment');
            }
        }
    };
    xmlhttp.open("POST", "../controller/comment_delete.php", true);
    xmlhttp.send(data);
};

var submit_comment = document.querySelectorAll("#delete_comment");
submit_comment.forEach(element => {
    element.addEventListener('click', delete_comments, true);
});
