<?php

require(__DIR__ . '/../model/socialwall.php');

if (isset($_SESSION['user']) && $_SESSION['user'] != "" && isset($_SESSION['user_id']) && $_SESSION['user_id'] != "") {
    $start_img = 0;
    $gallery = get_images($start_img, 1);
    require(__DIR__ . '/../view/socialwall.php');
} else {
    require(__DIR__ . '/../controller/index.php');
}
