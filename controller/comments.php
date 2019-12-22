<?php

require(__DIR__ . '/../model/socialwall.php');

if (!isset($_SESSION['user']) || $_SESSION['user'] == "" || !isset($_SESSION['user_id']) || $_SESSION['user_id'] == "") {
    require(__DIR__ . '/../controller/index.php');
} else {
    $image = get_image($img_id);
    if ($image === 0) {
        require(__DIR__ . '/../view/404.php');
    }
    $comments = get_comments($img_id);
}

require(__DIR__ . '/../view/comments.php');
