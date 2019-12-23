<?php

if (isset($_SESSION['user']) && $_SESSION['user'] != "" && isset($_SESSION['user_id']) && $_SESSION['user_id'] != "") {
    $_SESSION['user'] = "";
    $_SESSION['user_id'] = "";
    session_destroy();
    header("Location: /");
    exit;
}

require(__DIR__ . '/../../controller/index.php');
