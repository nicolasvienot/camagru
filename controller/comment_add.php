<?php

require (__DIR__ . '/../model/socialwall.php');

$res->result = 0;
$res->message = "There was a problem, please try again";

session_start();
$user_login = $_SESSION['user'];
$user_id = $_SESSION['user_id'];
$img_id = $_POST['img_id'];
$comment_content = $_POST['comment_content'];

$res_comment = add_comment($img_id, $user_id, $comment_content);
if ($res_comment->result !== 0) {
    $date = get_comment_date($res_comment->id_comment);
    $res->login = $user_login;
    $res->result = 1;
    $res->result_add = $res_comment->result;

    $res->message = "Comment added.";
    $res->comment_id = $res_comment->id_comment;
    $res->comment_date = $date;
}

$json = json_encode($res);
echo $json;

?>