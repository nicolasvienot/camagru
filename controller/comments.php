<?php

require(__DIR__ . '/../model/socialwall.php');

if (isset($_SESSION['user']) && $_SESSION['user'] != "" && isset($_SESSION['user_id']) && $_SESSION['user_id'] != "") {
    $image = get_image($img_id);
    if ($image === 0) {
        header("Location: /404");
        exit;
    }
    $comments = get_comments($img_id);
    require(__DIR__ . '/../view/comments.php');
} else {
    header("Location: /");
    exit;
}
