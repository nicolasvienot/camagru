<?php

require (__DIR__ . '/../../model/users.php');

$res->result = 0;
$res->message = "There was a problem, please try again";

if (empty($_POST["email_forgot"]) || $_POST["email_forgot"] == "")
{
    $res->result = 0;
    $res->message = "You need to fill the email";
    $json = json_encode($res);
    echo $json;
    return;
}

$user_email = htmlentities($_POST["email_forgot"]);
$test = send_forgot($user_email);

switch ($test) {
    case '1' :
        $res->result = 1;
        $res->message = "Mail sent!";
        break;
    case '2' :
        $res->result = 0;
        $res->message = "Error table users";
        break;
    case '3' :
        $res->result = 0;
        $res->message = "Not this mail in table users";
        break;
    default:
        $res->result = 0;
        $res->message = "There was a problem, please try again";
        break;
}

$json = json_encode($res);
echo $json;

?>