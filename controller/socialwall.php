<?php

require(__DIR__ . '/../model/socialwall.php');

if (!isset($_SESSION['user']) || $_SESSION['user'] === "") {
    require(__DIR__ . '/../controller/index.php');
} else {
    $start_img = 0;
    $gallery = get_images($start_img, 1);
}

require(__DIR__ . '/../view/socialwall.php');
