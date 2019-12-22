<?php

if (isset($_SESSION['user']) && $_SESSION['user'] !== "") {
    $logged = 1;
    require (__DIR__ . '/../../view/templates/header.php');
}
else {
    $logged = 0;
    require (__DIR__ . '/../../view/templates/header.php');
}

?>