<?php

session_start();

require(__DIR__ . '/../../model/users.php');

$res = new stdClass();
$res->result = 0;
$res->message = "Start!";

if (isset($_POST["password"]) && isset($_POST["password_check"]) && $_POST["password"] != "" && $_POST["password_check"] != "") {
    $new_password = $_POST['password'];
    $new_password_check = $_POST['password_check'];
    $key = $_POST["reset_key"];
    
    if ($new_password === $new_password_check) {
        $regex = '/^(?=.*[a-z])(?=.*[0-9])(?=.{8,})/';
        if (preg_match($regex, $new_password)) {
            $new_password = hash("sha256", $new_password);
            $test = reset_password($new_password, $key);
            if ($test === 1) {
                $res->result = 1;
                $res->message = "The password has been reset, you can now log in!";
            } else {
                $res->result = 0;
                $res->message = "There was an error, please try again or contact us!";
            }
        } else {
            $res->result = 0;
            $res->message = "The new password is not well formated!";
        }
    } else {
        $res->result = 0;
        $res->message = "The two password are different!";
    }
} else {
    $res->result = 0;
    $res->message = "You need to fill all the form!";
}

$json = json_encode($res);
echo $json;
