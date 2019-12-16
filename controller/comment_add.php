<?php

require (__DIR__ . '/../model/socialwall.php');

$res->result = 0;
$res->message = "There was a problem, please try again";

session_start();
$user_login = $_SESSION['user'];
$user_id = $_SESSION['user_id'];
$img_id = $_POST['img_id'];
$comment_content = $_POST['comment_content'];

$comment = add_comment($img_id, $user_id, $comment_content);
if ($comment === 1)
{
    $res->result = 1;
    $res->message = "Comment added.";
    $res->comment_id = $comment_content;
}

$json = json_encode($res);
echo $json;

?>