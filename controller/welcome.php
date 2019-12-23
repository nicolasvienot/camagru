<?php

require(__DIR__ . '/../model/socialwall.php');

if (isset($_SESSION['user']) && $_SESSION['user'] != "" && isset($_SESSION['user_id']) && $_SESSION['user_id'] != "") {
    header("Location: /");
    exit;
} else {
    $start_img = 0;
    $gallery = get_images($start_img, 0);
    require_once(__DIR__ . '/../view/welcome.php');
}
