<?php

require (__DIR__ . '/../../model/users.php');

// $res->result = 0;
// $res->message = "There was a problem, please try again";

if (empty($_POST["username"]) || empty($_POST["password"]))
{
    $res->result = 0;
    if (empty($_POST["username"]))
        $res->message = "You need to fill the username";
    else
        $res->message = "You need to fill the password";
    $json = json_encode($res);
    echo $json;
    return;
}

$login = htmlentities($_POST["username"]);
$password = htmlentities(hash('sha256', $_POST["password"]));

$test = signin($login, $password);

switch ($test) {
    case '1' :
        $res->result = 1;
        $res->message = "User logged in!";
        break;
    case '2' :
        $res->result = 0;
        $res->message = "Your account is not activated. Please check your email";
        break;
    case '3' :
        $res->result = 0;
        $res->message = "Wrong user or password";
        break;
    default:
        $res->result = 0;
        $res->message = "There was a problem, please try again";
        break;
}

$json = json_encode($res);
echo $json;

?>