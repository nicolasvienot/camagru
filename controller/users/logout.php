<?php

if (isset($_SESSION['user']) && $_SESSION['user'] != "") {
    session_start();
    $_SESSION['user'] = "";
    $_SESSION['user_id'] = "";
    header("Location: /");
}

?>