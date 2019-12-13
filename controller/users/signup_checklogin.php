<?php

include (__DIR__ . '/../../config/database.php');

$login_tosearch = $_REQUEST["login"];

$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT user_login from users";
$stmt = $pdo->query($sql);
$result = $stmt->fetchAll(PDO::FETCH_OBJ);
$logins = array_map(function($v){
    return $v->user_login;
}, $result);

foreach ($logins as &$login) {
    if ($login == $login_tosearch)
    {
        echo "false";
        return;
    }
}

echo "true";

?>