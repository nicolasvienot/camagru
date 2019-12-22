<?php

session_start();

require(__DIR__ . '/../../model/users.php');

$res = new stdClass();
$res->result = 0;
$res->message = "Start!";

if (empty($_POST['type'])) {
    $res->result = 0;
    $res->message = "Fatal error, no type!";
    $json = json_encode($res);
    echo $json;
    return;
}

$type = $login = htmlentities($_POST['type']);

switch ($type) {
    case 1:
        $res->type = 1;
        if (empty($_POST["new_login"]) || $_POST["new_login"] === "") {
            $res->result = 0;
            $res->message = "Empty login!";
        } else {
            $new_login = htmlentities($_POST['new_login']);
            $login = $_SESSION['user'];
            $user_id = $_SESSION['user_id'];
            // do checks
            $res->login = $login;
            $res->user_id = $user_id;
            $res->result2 = modify_username($new_login, $login, $user_id);

            $res->result = 1;
            $res->message = "I would need to modify the username!";
        }
        break;
    case 2:
        $res->type = 2;
        if (empty($_POST["new_email"]) || $_POST["new_email"] === "") {
            $res->result = 0;
            $res->message = "Empty email!";
        } else {
            $new_email = htmlentities($_POST['new_email']);
            $login = $_SESSION['user'];
            $user_id = $_SESSION['user_id'];
            // do checks
            modify_email($new_email, $login, $user_id);
            $res->result = 1;
            $res->message = "I would need to modify the email!";
        }
        break;
    case 3:
        $res->type = 3;
        if (empty($_POST["old_password"]) || $_POST["old_password"] === "" || empty($_POST["new_password"]) || $_POST["new_password"] === "" || empty($_POST["new_password_check"]) || $_POST["new_password_check"] === "") {
            $res->result = 0;
            $res->message = "Empty password!";
        } else {
            $old_password = htmlentities($_POST['old_password']);
            $new_password = htmlentities($_POST['new_password']);
            $new_password_check = htmlentities($_POST['new_password_check']);
            $login = $_SESSION['user'];
            $user_id = $_SESSION['user_id'];
            // do checks
            if ($new_password === $new_password_check) {
                $new_password = hash("sha256", $new_password);
                $old_password = hash("sha256", $old_password);
                $test = modify_password($old_password, $new_password, $login, $user_id);
                if ($test === 1) {
                    $res->result = 1;
                    $res->message = "Password modified!";
                } elseif ($test === 2) {
                    $res->result = 0;
                    $res->message = "Problem in update!";
                } elseif ($test === 3) {
                    $res->result = 0;
                    $res->message = "User unknown or bad password!";
                } else {
                    $res->result = 0;
                    $res->message = "Error unknown!";
                }
            } else {
                $res->result = 0;
                $res->message = "Not same password!";
            }
        }
        break;
    case 4:
        $login = $_SESSION['user'];
        $user_id = $_SESSION['user_id'];
        $user_notification = htmlentities($_POST['user_notification']);
        $test = modify_notification($user_id, $user_notification);
        if ($test === 1) {
            $res->result = 1;
            $res->message = "Notification modified!";
        } else {
            $res->result = 0;
            $res->message = "Error notification!";
        }
        break;
    default:
        $res->type = 0;
        $res->result = 0;
        $res->message = "Fatal error, unknown type!";
        break;
}

$json = json_encode($res);
echo $json;
