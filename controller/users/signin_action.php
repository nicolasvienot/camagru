<?php

require_once(__DIR__ . '/../../model/users.php');

$res = new stdClass();
$res->result = 0;
$res->message = "There was a problem, please try again";

if (isset($_POST["username"]) && $_POST["username"] != "" && isset($_POST["password"]) && $_POST["password"] != "") {
    $login = htmlentities($_POST["username"]);
    $password = hash('sha256', htmlentities($_POST["password"]));
    $test = signin($login, $password);

    switch ($test) {
        case '1':
            $res->result = 1;
            $res->message = "User logged in!";
            break;
        case '2':
            $res->result = 0;
            $res->message = "Your account is not activated, please check your emails";
            break;
        case '3':
            $res->result = 0;
            $res->message = "Wrong user or password";
            break;
        default:
            $res->result = 0;
            $res->message = "There was a problem, please try again or contact us";
            break;
    }
} else {
    $res->result = 0;
    if (empty($_POST["username"]) || $_POST['username'] == "") {
        $res->message = "You need to fill the username field";
    } else {
        $res->message = "You need to fill the password field";
    }
}

$json = json_encode($res);
echo $json;
