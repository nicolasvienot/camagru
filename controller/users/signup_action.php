<?php

require (__DIR__ . '/../../model/users.php');

if (empty($_POST["login"]) || empty($_POST["email"]) || empty($_POST["password"]) || empty($_POST["password_check"]) || empty($_POST["terms"])) {
    $res->result = 0;
    $res->message = "You need to fill all the form!";
    if (empty($_POST["terms"]))
        $res->message = "Please accept the terms and conditions!";
    // if (empty($_POST["username"]))
    //     $res->message = "You need to fill the username";
    // else
    //     $res->message = "You need to fill the password";
    $json = json_encode($res);
    echo $json;
    return;
}

$login = htmlentities($_POST["login"]);
$email = htmlentities($_POST["email"]);
$password = htmlentities($_POST["password"]);
$password_check = htmlentities($_POST["password_check"]);
$terms = htmlentities($_POST["terms"]);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $res->result = 0;
    $res->message = "The email is not well formated!";
    $json = json_encode($res);
    echo $json;
    return;
}

if ($password !== $password_check) {
    $res->result = 0;
    $res->message = "The two passwords don't match!";
    $json = json_encode($res);
    echo $json;
    return;
}

$password = hash("sha256", $password);

if ($terms !== "on") {
    $res->result = 0;
    $res->message = "Please accept the terms and conditions!";
    $json = json_encode($res);
    echo $json;
    return;
}

if (user_exists($login)) {
    $res->result = 0;
    $res->message = "user already exists!";
    $json = json_encode($res);
    echo $json;
    return;
}

if (email_exists($email)) {
    $res->result = 0;
    $res->message = "email already exists!";
    $json = json_encode($res);
    echo $json;
    return;
}

if (signup($login, $password, $email)) {
    $res->result = 1;
    $res->message = "Account created!";
    $json = json_encode($res);
    echo $json;
    return;
}

$res->result = 0;
$res->message = "There was a problem, please try again";
$json = json_encode($res);
echo $json;

?>