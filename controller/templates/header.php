<?php

session_start();
if (isset($_SESSION['user_logged']) && $_SESSION['user_logged'] !== "") {
    $logged = 1;
    require (__DIR__ . '/../../view/templates/header.php');
}
else {
    $logged = 0;
    require (__DIR__ . '/../../view/templates/header.php');
}

?>