<?php

if (isset($_SESSION['user']) && $_SESSION['user'] != "" && isset($_SESSION['user_id']) && $_SESSION['user_id'] != "") {
    require(__DIR__ . '/../controller/socialwall.php');
} else {
    require(__DIR__ . '/../controller/welcome.php');
}
