<?php

if (isset($_SESSION['user']) && $_SESSION['user'] != "" && isset($_SESSION['user_id']) && $_SESSION['user_id'] != "") {
    $logged = 1;
} else {
    $logged = 0;
}

require(__DIR__ . '/../../view/templates/header.php');
