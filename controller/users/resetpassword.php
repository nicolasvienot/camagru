<?php

require_once(__DIR__ . '/../../model/users.php');

if (isset($reset_key) && $reset_key != "") {
    $test = check_reset_password($reset_key);
    $res = new stdClass();
    switch ($test) {
        case '1':
            $res->result = 1;
            $res->message = "You can select a new pawssord!";
            break;
        case '2':
            $res->result = 2;
            $res->message = "The link provided has been used or has expired! Please try again";
            break;
        default:
            $res->result = 4;
            $res->message = "Your password couldn't be reset... Please contact us at nvienot@student.42.fr or create a new account.";
            break;
    }
} else {
    $res->result = 2;
    $res->message = "The link provided has been used or has expired! Please try again";
}

require(__DIR__ . '/../../view/users/resetpassword.php');
