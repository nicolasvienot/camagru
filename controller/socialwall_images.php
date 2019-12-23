<?php

session_start();

require_once(__DIR__ . '/../model/socialwall.php');

$res = new stdClass();
$res->result = 0;
$res->message = "There was a problem, please try again";
$start_img = $_POST['start_img'];

if (isset($_SESSION['user']) && $_SESSION['user'] != "" && isset($_SESSION['user_id']) && $_SESSION['user_id'] != "") {
    $gallery = get_images($start_img, 1);
} else {
    $gallery = get_images($start_img, 0);
}

if ($gallery !== 0) {
    if ($gallery === "") {
        $res->result = 2;
        $res->message = "No more images";
    } else {
        $res->result = 1;
        $res->message = "We got 8 more images";
    }
    $res->gallery = $gallery;
}

$json = json_encode($res);
echo $json;
