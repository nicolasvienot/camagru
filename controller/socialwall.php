<?php

require (__DIR__ . '/../model/socialwall.php');

session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] === "") {
    require(__DIR__ . '/../controller/index.php');
}
else {
    $gallery = get_images();
}

require(__DIR__ . '/../view/socialwall.php');


?>