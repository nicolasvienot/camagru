<?php

include ('connect.php');

$login_tosearch = $_REQUEST["login"];

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