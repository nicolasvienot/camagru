<?php

require_once(__DIR__ . '/../../model/users.php');

$res = new stdClass();
$res->result = 0;
$res->message = "There was a problem, please try again";

if (isset($_POST["login"]) && $_POST["login"] != "" && isset($_POST["email"]) && $_POST["email"] != "" && isset($_POST["password"]) && $_POST["password"] != "" && isset($_POST["password_check"]) && $_POST["password_check"] != "" && isset($_POST["terms"]) && $_POST["terms"] != "") {
    $login = htmlentities($_POST["login"]);
    $email = htmlentities($_POST["email"]);
    $password = $_POST["password"];
    $password_check = $_POST["password_check"];
    $terms = htmlentities($_POST["terms"]);
 
    if (!ctype_alnum($login) || strlen($login) < 4 || strlen($login) > 16) {
        $res->result = 0;
        $res->message = "The username is not well formated!";
        $json = json_encode($res);
        echo $json;
        return;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $res->result = 0;
        $res->message = "The email is not well formated!";
        $json = json_encode($res);
        echo $json;
        return;
    }

    $regex = '/^(?=.*[a-z])(?=.*[0-9])(?=.{8,})/';

    if (!preg_match($regex, $password)) {
        $res->result = 0;
        $res->message = "The password is not well formated!";
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
} else {
    $res->result = 0;
    if (empty($_POST["login"]) || $_POST["login"] == "") {
        $res->message = "Please fill the login field!";
    } elseif (empty($_POST["email"]) || $_POST["email"] == "") {
        $res->message = "Please fill the email field!";
    } elseif (empty($_POST["password"]) || $_POST["password"] == "") {
        $res->message = "Please fill the password field!";
    } elseif (empty($_POST["password_check"]) || $_POST["password_check"] == "") {
        $res->message = "Please fill the password check field!!";
    } elseif (empty($_POST["terms"]) || $_POST["terms"] == "") {
        $res->message = "Please accept the terms and conditions!";
    } else {
        $res->message = "You need to fill all the fields!";
    }
    $json = json_encode($res);
    echo $json;
    return;
}

$json = json_encode($res);
echo $json;
