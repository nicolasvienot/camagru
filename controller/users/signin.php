<?php

if (isset($_SESSION['user']) && $_SESSION['user'] != "" && isset($_SESSION['user_id']) && $_SESSION['user_id'] != "") {
    header("Location: /");
    exit;
} else {
    require(__DIR__ . '/../../view/users/signin.php');
}
