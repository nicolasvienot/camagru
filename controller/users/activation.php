<?php

    require (__DIR__ . '/../../model/users.php');

// session_start();
// if (isset($_SESSION['user']) && $_SESSION['user'] !== "") {
//     require( __DIR__ . '/../../view/socialwall.php');
// }
// else {

    if (!isset($login) || $login === "" || !isset($key) || $key === "") {
        require( __DIR__ . '/../../controller/index.php');
    }
    else
    {
        $test = activate_account($login, $key);

        switch ($test) {
            case '1' :
                $res->result = 1;
                $res->message = "Your account has been activated successfully! You can now log in!";
                break;
            case '2' :
                $res->result = 2;
                $res->message = "Your account has already been activated. Please log in!";
                break;
            case '3' :
                $res->result = 3;
                $res->message = "Your account couldn't be activated... Please contact us at nvienot@student.42.fr or create a new account.";
                break;
            default:
                $res->result = 4;
                $res->message = "Your account couldn't be activated... Please contact us at nvienot@student.42.fr or create a new account.";
                break;
        }
        require( __DIR__ . '/../../view/users/activation.php');
    }
// }

?>