<?php

session_start();
if (isset($_SESSION['user_logged']) && $_SESSION['user_logged'] !== "") {
    require(__DIR__ . '/../../view/socialwall.php');
}
else {
    require(__DIR__ . '/../../view/users/signup.php');
}


?>