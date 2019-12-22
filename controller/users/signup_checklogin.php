<?php

require (__DIR__ . '/../../model/users.php');

$res = new stdClass();
$res->result = 0;
$res->message = "There was a problem, please try again";

$login_tosearch = $_REQUEST["login"];

$test = user_exists($login_tosearch);
if ($test === 1)
    $res->result = 1;

$json = json_encode($res);
echo $json;

?>