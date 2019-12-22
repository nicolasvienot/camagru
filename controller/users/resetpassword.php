<?php

require(__DIR__ . '/../../model/users.php');

if (isset($_SESSION['user']) && $_SESSION['user'] != "" && isset($_SESSION['user_id']) && $_SESSION['user_id'] != "") {
    $test = check_reset_password($reset_key);
    $res = new stdClass();
    switch ($test) {
        case '1':
            $res->result = 1;
            $res->message = "Please select a new passord!";
            break;
        case '2':
            $res->result = 2;
            $res->message = "The link provided has been used or has expired!";
            break;
        default:
            $res->result = 4;
            $res->message = "Your password couldn't be reset... Please contact us at nvienot@student.42.fr or create a new account.";
            break;
    }
    require(__DIR__ . '/../../view/users/resetpassword.php');
} else {
    require(__DIR__ . '/../../controller/index.php');
}
