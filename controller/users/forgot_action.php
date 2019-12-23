<?php

session_start();

require_once(__DIR__ . '/../../model/users.php');

$res = new stdClass();
$res->result = 0;
$res->message = "There was a problem, please try again";

if (isset($_POST["email_forgot"]) && $_POST["email_forgot"] != "") {
    $user_email = htmlentities($_POST["email_forgot"]);
    $test = send_forgot($user_email);
    switch ($test) {
            case '1':
                $res->result = 1;
                $res->message = "An email has been sent!";
                break;
            case '2':
                $res->result = 0;
                $res->message = "There was a problem, please try again or contact us";
                break;
            case '3':
                $res->result = 0;
                $res->message = "We don't know this email, please try again!";
                break;
            default:
                $res->result = 0;
                $res->message = "There was a problem, please try again or contact us";
                break;
        }
} else {
    $res->result = 0;
    $res->message = "You need to fill the email";
}
    $json = json_encode($res);
    echo $json;
