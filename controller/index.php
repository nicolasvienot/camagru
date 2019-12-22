<?php

if (isset($_SESSION['user']) && $_SESSION['user'] !== "") {
    require(__DIR__ . '/../controller/socialwall.php');
}
else {
    require(__DIR__ . '/../controller/welcome.php');
}

?>