<?php

require (__DIR__ . '/../../model/users.php');

if (isset($_SESSION['user']) && $_SESSION['user'] !== "") {
    $user_id = $_SESSION['user_id'];
    $notif = get_user_notif($user_id);
    require( __DIR__ . '/../../view/users/modifyaccount.php');
}
else {
    require( __DIR__ . '/../../view/users/index.php');
}

?>