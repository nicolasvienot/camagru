<?php

if (isset($_SESSION['user']) && $_SESSION['user'] != "" && isset($_SESSION['user_id']) && $_SESSION['user_id'] != "") {
    require(__DIR__ . '/../../controller/index.php');
} else {
    require(__DIR__ . '/../../view/users/signin.php');
}
