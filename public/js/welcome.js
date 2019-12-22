var start_img = 8;
var loading = 0;
var nomore_img = 0;

function handle_scroll_endpage(event) {
    
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight && (event.deltaY > 0) && loading !== 1 && nomore_img === 0)
    {
        loading = 1;
        var data = new FormData();
        data.append('start_img', start_img);
        data.append('connected', 0);
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
                        var items = document.querySelectorAll(".level-item");
                        items.forEach(element => {
                            if (element.getAttribute('clickable') !== 'false') {
                                element.style = 'pointer-events:none;';
                                element.setAttribute('clickable', 'false');
                            }
                        });
                        start_img += 8;
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

var items = document.querySelectorAll(".level-item");
items.forEach(element => {
    if (element.getAttribute('clickable') !== 'false') {
        element.style = 'pointer-events:none;';
        element.setAttribute('clickable', 'false');
    }
});

window.addEventListener('wheel', handle_scroll_endpage, true);