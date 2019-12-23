<?php

require_once(__DIR__ . '/../../model/users.php');

$res = new stdClass();
$res->result = 0;
$res->message = "There was a problem, please try again";

$email_tosearch = $_REQUEST["email"];

$test = email_exists($email_tosearch);
if ($test === 1) {
    $res->result = 1;
}

$json = json_encode($res);
echo $json;
