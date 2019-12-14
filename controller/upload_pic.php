<?php

require (__DIR__ . '/../model/upload.php');

$res->result = 0;
$res->message = "There was a problem, please try again";
$res->img_path = "";

session_start();
$user_id = htmlentities($_SESSION['user_id']);
$user_login = htmlentities($_SESSION['login']);
// try {$conn = new PDO("$DB_DSN", $DB_USER, $DB_PASSWORD);
// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);}
// catch (Exception $e) {die("Unsuccessful access to database.");}

$upload_dir = __DIR__ . '/../public/img/';
$img = $_POST['img'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
// $file_name = time() . "_" . $user_id .".png";
$file_name = time() . $user_id . ".png";

$file = $upload_dir . $file_name;
header("Content-type: image/png");
 
$image = imagecreatefromstring($data);
// $mini_left = imagecreatefrompng('/Users/cnairi/Applications/mamp/apache2/htdocs' . $_POST['hidden_filter']);
// $filter_width = imageSX($mini_left);
// $filter_height = imageSY($mini_left);
// $img_width = imageSX($image);
// $img_height = imageSY($image);
// imageCopyResized($image,$mini_left,$img_width / 3,20,0,0,$img_width,$img_height,$filter_width,$filter_height);
// $stmt = $conn->prepare("INSERT INTO MyImg (img_name, user_id, user_login) 
// VALUES (:img_name, :user_id, :user_login)");
// $stmt->bindParam(':img_name', $img_name);
// $stmt->bindParam(':user_id', $user_id);
// $stmt->bindParam(':user_login', $user_login);
$img_name = $file_name;
// $user_login = htmlentities($_SESSION['login']);
// $stmt->execute();
$success = imagepng($image, $file);

$res->result = 1;
$res->message = "Image uploaded.";
$res->img_path = "../public/img/" . $img_name;

$json = json_encode($res);
echo $json;

?>