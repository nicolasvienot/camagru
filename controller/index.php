<?php

require_once(__DIR__ . '/../config/setup.php');

session_start();
if (isset($_SESSION['user_logged']) && $_SESSION['user_logged'] !== "") {
    require(__DIR__ . '/../view/socialwall.php');
}
else {
    require(__DIR__ . '/../view/welcome.php');
}

?>