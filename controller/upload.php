<?php

require (__DIR__ . '/../model/upload.php');

if (isset($_SESSION['user']) && $_SESSION['user'] !== "") {
    $user_login = $_SESSION['user'];
    $user_id = $_SESSION['user_id'];
    $gallery = get_own_images($user_id);
    require(__DIR__ . '/../view/upload.php');
}
else {
    require(__DIR__ . '/../controller/index.php');
}

?>