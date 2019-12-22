<?php

if (isset($_SESSION['user']) && $_SESSION['user'] !== "") {
    require( __DIR__ . '/../../view/socialwall.php');
}
else {
    require( __DIR__ . '/../../view/users/signin.php');
}

?>