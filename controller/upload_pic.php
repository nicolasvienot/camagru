<?php

require (__DIR__ . '/../model/upload.php');

$res->result = 0;
$res->message = "There was a problem, please try again";
$res->img_path = "";

session_start();
$user_login = $_SESSION['user'];
$user_id = $_SESSION['user_id'];

$upload_dir = __DIR__ . '/../public/img/uploads/';
$img = $_POST['img'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
header("Content-type: image/png");

// check if exists

$image = imagecreatefromstring($data);

// $mini_left = imagecreatefrompng('/Users/cnairi/Applications/mamp/apache2/htdocs' . $_POST['hidden_filter']);
// $filter_width = imageSX($mini_left);
// $filter_height = imageSY($mini_left);
// $img_width = imageSX($image);
// $img_height = imageSY($image);
// imageCopyResized($image,$mini_left,$img_width / 3,20,0,0,$img_width,$img_height,$filter_width,$filter_height);

$now = DateTime::createFromFormat('U.u', microtime(true));
$time = $now->format("mdYHisu");
$file_name = $time . '_' . mt_rand() . '_' . $user_id . '.png';
$file_path = $upload_dir . $file_name;
$img_path = 'public/img/uploads/' . $file_name;
$img_id = upload_img($img_path, $user_login, $user_id);

$success = imagepng($image, $file_path);
$res->exists = file_exists($file_path);

$res->result = 1;
$res->message = "Image uploaded.";
$res->img_path = $img_path;
$res->img_id = $img_id;

$json = json_encode($res);
echo $json;



?>