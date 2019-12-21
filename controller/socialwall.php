<?php

require (__DIR__ . '/../model/socialwall.php');

session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] === "") {
    require(__DIR__ . '/../controller/index.php');
}
else {
    $start_gallery = 0; 
    $gallery = get_images($start_gallery);
}

require(__DIR__ . '/../view/socialwall.php');


?>