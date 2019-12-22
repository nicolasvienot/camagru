<?php

if (isset($_SESSION['user']) && $_SESSION['user'] != "") {
    $_SESSION['user'] = "";
    $_SESSION['user_id'] = "";
    session_destroy();
    header("Location: /");
}
