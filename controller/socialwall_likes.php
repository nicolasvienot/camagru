<?php

session_start();

require_once(__DIR__ . '/../model/socialwall.php');

$res = new stdClass();
$res->result = 0;
$res->message = "There was a problem, please try again";

$user_login = $_SESSION['user'];
$user_id = $_SESSION['user_id'];
$img_id = $_POST['img_id'];

$like = manage_likes($img_id, $user_id);
if ($like !== 0) {
    if ($like === 1) {
        $res->result = 1;
        $res->message = "Like added.";
    } else {
        $res->result = 2;
        $res->message = "Like removed.";
    }
}

$json = json_encode($res);
echo $json;
