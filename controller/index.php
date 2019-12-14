<?php

require_once(__DIR__ . '/../config/setup.php');

session_start();
if (isset($_SESSION['user']) && $_SESSION['user'] !== "") {
    require(__DIR__ . '/../controller/socialwall.php');
}
else {
    require(__DIR__ . '/../view/welcome.php');
}

?>