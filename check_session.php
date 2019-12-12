<?php

session_start();
if (!isset($_SESSION['user_logged']) && $_SESSION['user_logged'] == "") {
  header("Location: ../index.php");
}

?>