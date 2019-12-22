<?php

require (__DIR__ . '/../model/upload.php');

$res->result = 0;
$res->message = "There was a problem, please try again";

session_start();
$user_login = $_SESSION['user'];
$user_id = $_SESSION['user_id'];
$img_id = $_POST['img_id'];

$path = delete_image_db($img_id);
if ($path !== 0) {
    unlink('../' . $path) or die("Couldn't delete file");
    $res->path = $path;
    $res->result = 1;
    $res->message = "Image deleted.";
}

$json = json_encode($res);
echo $json;

?>