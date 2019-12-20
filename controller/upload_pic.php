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
$filter = $_POST['filter'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
header("Content-type: image/png");

// check if exists

$image = imagecreatefromstring($data);

$filter = imagecreatefrompng(__DIR__ . $filter);
// list($img_width, $img_height) = getimagesize($image);
// list($filter_width, $filter_height) = getimagesize($filter);

$filter_width = imageSX($filter);
$filter_height = imageSY($filter);
$img_width = imageSX($image);
$img_height = imageSY($image);

$res->img_width = $img_width;
$res->img_height = $img_height;
$res->filter_width = $filter_width;
$res->filter_height = $filter_height;

imagecopy($image, $filter, $_POST['x'], $_POST['y'], 0, 0, $filter_width, $filter_height);

// imageCopyResized($image, $filter, $_POST['x'], $_POST['y'], 0, 0, 640, 280, 200, 100);
// imageCopyResized($image, $filter, 0, 0, 0, 0, 640, 480, 200, 100);
// imagecopyresampled ($image, $filter, 0, 0, $img_width, $img_height, $filter_width, $filter_height, $$filter_width, $filter_height);
// imageCopyResized($image, $filter,0,0,0,0,$img_width,$img_height,$filter_width,$filter_height);

// imageCopyResized($image, $filter, $img_width / 3, 20, 0, 0, $img_width, $img_height, $filter_width, $filter_height);
// imagecopyresampled ($image, $filter, $img_width / 3, 20, 0, 0, $img_width, $img_height, $filter_width, $filter_height);
// imagecopymerge($image, $filter, $_POST['x'], $_POST['y'], 0, 0, 200, 100, 100);


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