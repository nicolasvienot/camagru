<?php

session_start();

require_once(__DIR__ . '/../model/socialwall.php');

$res = new stdClass();
$res->result = 0;
$res->message = "There was a problem, please try again";

$user_login = $_SESSION['user'];
$user_id = $_SESSION['user_id'];
$comment_id = $_POST['comment_id'];

$comment = delete_comment($comment_id, $user_id);
if ($comment !== 0) {
    if ($comment === 1) {
        $res->result = 1;
        $res->message = "Comment deleted.";
    }
    if ($comment === 2) {
        $res->result = 2;
        $res->message = "No rights to delete comment.";
    }
}

$json = json_encode($res);
echo $json;
