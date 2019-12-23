<?php

require_once(__DIR__ . '/../model/upload.php');

if (isset($_SESSION['user']) && $_SESSION['user'] != "" && isset($_SESSION['user_id']) && $_SESSION['user_id'] != "") {
    $user_login = $_SESSION['user'];
    $user_id = $_SESSION['user_id'];
    $gallery = get_own_images($user_id);
    require(__DIR__ . '/../view/upload.php');
} else {
    header("Location: /");
    exit;
}
