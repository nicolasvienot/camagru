<?php

session_start();
if (isset($_SESSION['user']) && $_SESSION['user'] !== "") {
    require( __DIR__ . '/../../view/users/modifyaccount.php');
}
else {
    require( __DIR__ . '/../../view/users/index.php');
}

?>