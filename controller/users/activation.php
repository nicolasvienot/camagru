<?php

require(__DIR__ . '/../../model/users.php');

if (isset($login) && $login != "" && isset($key) && $key != "") {
    $test = activate_account($login, $key);
    $res = new stdClass();
    switch ($test) {
        case '1':
            $res->result = 1;
            $res->message = "Your account has been activated successfully! You can now log in!";
            break;
        case '2':
            $res->result = 2;
            $res->message = "Your account has already been activated. Please log in!";
            break;
        case '3':
            $res->result = 3;
            $res->message = "Your account couldn't be activated... Please contact us at nvienot@student.42.fr or create a new account.";
            break;
        default:
            $res->result = 4;
            $res->message = "Your account couldn't be activated... Please contact us at nvienot@student.42.fr or create a new account.";
            break;
    }
    require(__DIR__ . '/../../view/users/activation.php');
} else {
    require(__DIR__ . '/../../controller/index.php');
}
