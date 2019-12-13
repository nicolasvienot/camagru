<?php

session_start();
if (isset($_SESSION['user_logged']) && $_SESSION['user_logged'] !== "") {
    require(__DIR__ . '/../../view/templates/header_logged.php');
}
else {
    require(__DIR__ . '/../../view/templates/header_notlogged.php');
}

?>