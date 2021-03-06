function do_like(event) {
  var data = new FormData();
  var span_like = event.currentTarget.children[0];
  var span_nblikes = event.currentTarget.children[1];
  data.append(
    "img_id",
    document.getElementById("img_container").children[0].id
  );
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var res = JSON.parse(this.responseText);
      if (res.result === 1) {
        span_like.classList.add("has-text-danger");
        var nblikes = parseInt(span_nblikes.innerText) + 1;
        span_nblikes.innerText = nblikes;
      } else if (res.result === 2) {
        span_like.classList.remove("has-text-danger");
        var nblikes = parseInt(span_nblikes.innerText) - 1;
        span_nblikes.innerText = nblikes;
      } else {
        console.log("Error nblikes");
      }
    }
  };
  xmlhttp.open("POST", "../controller/socialwall_likes.php", true);
  xmlhttp.send(data);
}

document.querySelector(".like").addEventListener("click", do_like, true);

function do_share(event) {
  var img_id = document.getElementById("img_container").children[0].id;
  var twitter_url = "http://twitter.com/share?";
  var params = {
    url: "http://localhost:8080/comments/?img_id=" + img_id,
    text: "Look at this picture on Camagru!",
    hashtags: "camagru, picture"
  };
  for (var prop in params)
    twitter_url += "&" + prop + "=" + encodeURIComponent(params[prop]);
  window.open(
    twitter_url,
    "",
    "left=0,top=0,width=550,height=450,personalbar=0,toolbar=0,scrollbars=0,resizable=0"
  );
}

document.querySelector(".share").addEventListener("click", do_share, true);

function push_comments(event) {
  if (document.getElementById("comment_content").value != "") {
    document.getElementById("submit_comment").classList.add("is-loading");
    var data = new FormData();
    comment_content = document.getElementById("comment_content").value;
    data.append(
      "img_id",
      document.getElementById("img_container").children[0].id
    );
    data.append("comment_content", comment_content);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var res = JSON.parse(this.responseText);
        if (res.result !== 0) {
          var divcomment = document.createElement("div");
          divcomment.id = res.comment_id;
          var pcomment = document.createElement("p");
          var test =
            "<strong>" +
            res.login +
            "</strong> <small>@" +
            res.login +
            " " +
            res.comment_date +
            '</small> <a class="delete is-small" id="delete_comment"></a><br>'
            
          var cont_comment = document.createTextNode(comment_content);
          pcomment.innerHTML = test;
          pcomment.appendChild(cont_comment);
          pcomment.children[2].addEventListener("click", delete_comment, true);
          divcomment.appendChild(pcomment);
          document.getElementById("comments_div").append(divcomment);
          document.getElementById("comment_content").value = "";
          document.getElementById("submit_comment").classList.remove("is-loading");
        } else {
          document.getElementById("submit_comment").classList.remove("is-loading");
          console.log("Error push_comment");
        }
      }
    };
    xmlhttp.open("POST", "../controller/comment_add.php", true);
    xmlhttp.send(data);
  }
}

var submit_comment = document.getElementById("submit_comment");
submit_comment.addEventListener("click", push_comments, true);

function delete_comment(event) {
  if (confirm("Are you sure you want to delete this comment?")) {
    var data = new FormData();
    data.append("comment_id", event.srcElement.parentElement.parentElement.id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var res = JSON.parse(this.responseText);
        if (res.result === 1) {
          document.getElementById(event.srcElement.parentElement.parentElement.id).remove();
        } else {
          console.log("Error delete_comment");
        }
      }
    };
    xmlhttp.open("POST", "../controller/comment_delete.php", true);
    xmlhttp.send(data);
  }
}

var submit_comment = document.querySelectorAll("#delete_comment");
submit_comment.forEach(element => {
  element.addEventListener("click", delete_comment, true);
});
