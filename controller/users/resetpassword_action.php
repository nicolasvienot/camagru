<?php

require (__DIR__ . '/../../model/users.php');

if (empty($_POST["password"]) || empty($_POST["password_check"]) || $_POST["password"] == "" || $_POST["password_check"] == "") {
    $res->result = 0;
    $res->p1 = $_POST["password"];
    $res->p2 = $_POST["password_check"];
    $res->message = "You need to fill all the form!";
    $json = json_encode($res);
    echo $json;
    return;
}

$password = htmlentities($_POST["password"]);
$password_check = htmlentities($_POST["password_check"]);
$key = htmlentities($_POST["reset_key"]);

if ($password !== $password_check) {
    $res->result = 0;
    $res->message = "The two passwords don't match!";
    $json = json_encode($res);
    echo $json;
    return;
}

$password = hash("sha256", $password);
$test = reset_password($password, $key);

switch ($test) {
    case '1' :
        $res->result = 1;
        $res->message = "The password has been reset, you can now log in!";
        break;
    default:
        $res->result = 0;
        $res->message = "There was a problem, user unknown";
        break;
}

$json = json_encode($res);
echo $json;

?>