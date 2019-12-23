<?php

session_start();

require(__DIR__ . '/../../model/users.php');

$res = new stdClass();
$res->result = 0;
$res->message = "Start!";

if (isset($_POST['type']) && $_POST['type'] != "") {
    $type = htmlentities($_POST['type']);
    switch ($type) {
        case 1:
            $res->type = 1;
            if (isset($_POST["new_login"]) && $_POST["new_login"] != "") {
                $new_login = htmlentities($_POST['new_login']);
                if (isset($_SESSION['user']) && $_SESSION['user'] != "" && isset($_SESSION['user_id']) && $_SESSION['user_id'] != "") {
                    $login = $_SESSION['user'];
                    $user_id = $_SESSION['user_id'];
                    if (!ctype_alnum($new_login) || strlen($new_login) < 4 || strlen($new_login) > 16) {
                        $res->result = 0;
                        $res->message = "The username is not well formated!";
                    } else {
                        if (user_exists($new_login)) {
                            $res->result = 0;
                            $res->message = "Username already exists, please choose another!";
                        } else {
                            $res->login = $login;
                            $res->user_id = $user_id;
                            modify_username($new_login, $login, $user_id);
                            $res->result = 1;
                            $res->message = "Your username has been modified!";
                        }
                    }
                } else {
                    $res->result = 0;
                    $res->message = "Error, please login!";
                }
            } else {
                $res->result = 0;
                $res->message = "Please check the fields!";
            }
            break;
        case 2:
            $res->type = 2;
            if (isset($_POST["new_email"]) && $_POST["new_email"] != "") {
                $new_email = htmlentities($_POST['new_email']);
                if (isset($_SESSION['user']) && $_SESSION['user'] != "" && isset($_SESSION['user_id']) && $_SESSION['user_id'] != "") {
                    $login = $_SESSION['user'];
                    $user_id = $_SESSION['user_id'];
                    if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
                        $res->result = 0;
                        $res->message = "The email is not well formated!";
                    } else {
                        if (email_exists($new_email)) {
                            $res->result = 0;
                            $res->message = "Email already exists, please choose another!";
                        } else {
                            modify_email($new_email, $login, $user_id);
                            $res->result = 1;
                            $res->message = "Your email has been modified!";
                        }
                    }
                } else {
                    $res->result = 0;
                    $res->message = "Error, please login!";
                }
            } else {
                $res->result = 0;
                $res->message = "Please check the fields!";
            }
            break;
        case 3:
            $res->type = 3;
            if (isset($_POST["old_password"]) && $_POST["old_password"] != "" && isset($_POST["new_password"]) && $_POST["new_password"] != "" && isset($_POST["new_password_check"]) && $_POST["new_password_check"] != "") {
                $old_password = $_POST['old_password'];
                $new_password = $_POST['new_password'];
                $new_password_check = $_POST['new_password_check'];
                if (isset($_SESSION['user']) && $_SESSION['user'] != "" && isset($_SESSION['user_id']) && $_SESSION['user_id'] != "") {
                    $login = $_SESSION['user'];
                    $user_id = $_SESSION['user_id'];
                    if ($new_password === $new_password_check) {
                        $regex = '/^(?=.*[a-z])(?=.*[0-9])(?=.{8,})/';
                        if (preg_match($regex, $new_password)) {
                            $new_password = hash("sha256", $new_password);
                            $old_password = hash("sha256", $old_password);
                            $test = modify_password($old_password, $new_password, $login, $user_id);
                            if ($test === 1) {
                                $res->result = 1;
                                $res->message = "Your password has been modified!";
                            } elseif ($test === 2) {
                                $res->result = 0;
                                $res->message = "Problem in password update, please try again or contact us!";
                            } elseif ($test === 3) {
                                $res->result = 0;
                                $res->message = "There was an error, please try again or contact us!";
                            } else {
                                $res->result = 0;
                                $res->message = "Error unknown!";
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
                    $res->message = "Error, please login!";
                }
            } else {
                $res->result = 0;
                $res->message = "Please check the fields!";
            }
            break;
        case 4:
            if (isset($_SESSION['user']) && $_SESSION['user'] != "" && isset($_SESSION['user_id']) && $_SESSION['user_id'] != "") {
                $login = $_SESSION['user'];
                $user_id = $_SESSION['user_id'];
                $user_notification = htmlentities($_POST['user_notification']);
                $test = modify_notification($user_id, $user_notification);
                if ($test === 1) {
                    $res->result = 1;
                    $res->message = "User notification modified!";
                } else {
                    $res->result = 0;
                    $res->message = "Problem in update notification, please try again or contact us!";
                }
            } else {
                $res->result = 0;
                $res->message = "Error, please login!";
            }
            break;
        default:
            $res->type = 0;
            $res->result = 0;
            $res->message = "Fatal error, unknown type!";
            break;
    }
} else {
    $res->result = 0;
    $res->message = "There was an error, please try again or contact us!";
}

$json = json_encode($res);
echo $json;
