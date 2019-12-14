<?php

session_start();
if (isset($_SESSION['user']) && $_SESSION['user'] !== "") {
    require(__DIR__ . '/../view/upload.php');
}
else {
    require(__DIR__ . '/../controller/index.php');
}

?>