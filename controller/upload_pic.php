<?php

session_start();

require (__DIR__ . '/../model/upload.php');

$res = new stdClass();
$res->result = 0;
$res->message = "There was a problem, please try again";
$res->img_path = "";

$user_login = $_SESSION['user'];
$user_id = $_SESSION['user_id'];

$upload_dir = __DIR__ . '/../public/img/uploads/';
$img = $_POST['img'];
$filter = $_POST['filter'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
header("Content-type: image/png");

if ($data !== false) {
    $image = imagecreatefromstring($data);
    if ($image !== false) {
        $filter = imagecreatefrompng(__DIR__ . $filter);
        if ($filter !== false) {
            $filter_width = imageSX($filter);
            $filter_height = imageSY($filter);
            $img_width = imageSX($image);
            $img_height = imageSY($image);
            $res->img_width = $img_width;
            $res->img_height = $img_height;
            $res->filter_width = $filter_width;
            $res->filter_height = $filter_height;
            $copy = imagecopy($image, $filter, $_POST['x'], $_POST['y'], 0, 0, $filter_width, $filter_height);
            if ($copy !== false) {
                $now = DateTime::createFromFormat('U.u', microtime(true));
                $time = $now->format("mdYHisu");
                $file_name = $time . '_' . mt_rand() . '_' . $user_id . '.png';
                $file_path = $upload_dir . $file_name;
                $img_path = 'public/img/uploads/' . $file_name;
                $img_id = upload_img($img_path, $user_login, $user_id);
                if ($img_id !== 0) {
                    $success = imagepng($image, $file_path);
                    if ($success !== false){
                        $res->exists = file_exists($file_path);
                        $res->result = 1;
                        $res->message = "Image uploaded.";
                        $res->img_path = $img_path;
                        $res->img_id = $img_id;
                    }
                }
            }
        }
    }
}

$json = json_encode($res);
echo $json;



?>