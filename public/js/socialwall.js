var start_img = 8;
var loading = 0;
var nomore_img = 0;

function do_like(event) {
    var data = new FormData();
    var span_like = event.currentTarget.children[0];
    var span_nblikes = event.currentTarget.children[2];
    data.append('img_id', event.currentTarget.parentElement.parentElement.parentElement.id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var res = JSON.parse(this.responseText);
            if (res.result === 1) {
                span_like.classList.add('has-text-danger');
                var nblikes = parseInt(span_nblikes.innerText) + 1;
                span_nblikes.innerText = nblikes;
            }
            else if (res.result === 2) {
                span_like.classList.remove('has-text-danger');
                var nblikes = parseInt(span_nblikes.innerText) - 1;
                span_nblikes.innerText = nblikes;
            }           
            else {
                console.log('Error nblikes');
            }
        }
    };
    xmlhttp.open("POST", "../controller/socialwall_likes.php", true);
    xmlhttp.send(data);
};


var likes = document.querySelectorAll(".like");
likes.forEach(element => {
    element.addEventListener('click', do_like, true);
    element.setAttribute('listener', 'true');
});

function do_comments(event) {
    var img_id = event.currentTarget.parentElement.parentElement.parentElement.id;
    window.location.href = "/comments/?img_id=" + img_id;
};

var comments = document.querySelectorAll(".comment");
comments.forEach(element => {
    element.addEventListener('click', do_comments, true);
    element.setAttribute('listener', 'true');
});

function do_share(event) {
    var img_id = event.currentTarget.parentElement.parentElement.parentElement.id;
    console.log(img_id)
    var twitter_url = "http://twitter.com/share?";
    var params = {
        url: "http://localhost:8080/comments/?img_id=" + img_id, 
        text: "Look at this picture on Camagru!",
        hashtags: "camagru, picture"
    }
    for (var prop in params) twitter_url += '&' + prop + '=' + encodeURIComponent(params[prop]);
    window.open(twitter_url, '', 'left=0,top=0,width=550,height=450,personalbar=0,toolbar=0,scrollbars=0,resizable=0');
}

var shares = document.querySelectorAll(".share");
shares.forEach(element => {
    element.addEventListener('click', do_share, true);
    element.setAttribute('listener', 'true');
});

function handle_scroll_endpage(event) {
    
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight && (event.deltaY > 0) && loading !== 1 && nomore_img === 0)
    {
        loading = 1;
        var data = new FormData();
        data.append('start_img', start_img);
        data.append('connected', 1);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var res = JSON.parse(this.responseText);
                console.log(res)
                if (res.result === 1) {
                    document.getElementById('loadingbutton').style.display = "";
                    setTimeout(() => {
                        document.getElementById('loadingbutton').style.display = "none";
                        document.getElementById('col_gallery').insertAdjacentHTML('beforeend', res.gallery);
                        start_img += 8;
                        var shares = document.querySelectorAll(".share");
                        shares.forEach(element => {
                            if (element.getAttribute('listener') !== 'true') {
                                element.addEventListener('click', do_share, true);
                                element.setAttribute('listener', 'true');
                            }
                        });
                        var comments = document.querySelectorAll(".comment");
                        comments.forEach(element => {
                            if (element.getAttribute('listener') !== 'true') {
                                element.addEventListener('click', do_comments, true);
                                element.setAttribute('listener', 'true');
                            }
                        });
                        var likes = document.querySelectorAll(".like");
                        likes.forEach(element => {
                            if (element.getAttribute('listener') !== 'true') {
                                element.addEventListener('click', do_like, true);
                                element.setAttribute('listener', 'true');
                            }
                        });
                        setTimeout(() => { 
                            loading = 0;
                        }, 500);
                    }, 1000);
                }  
                else if (res.result === 2)
                {
                    document.getElementById('endimages').style.display = "";
                    nomore_img = 1;
                    setTimeout(() => { loading = 0 }, 1000);
                }       
                else {
                    setTimeout(() => { loading = 0 }, 1000);
                    console.log('Error getting more images');
                }
            }
        };
        xmlhttp.open("POST", "../controller/socialwall_images.php", true);
        xmlhttp.send(data);
    }
}

window.addEventListener('wheel', handle_scroll_endpage, true);