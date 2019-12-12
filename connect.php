<?php

$dbname = getenv('CAMAGRU_DBNAME');
$user = getenv('CAMAGRU_DBUSER');
$passwd = getenv('CAMAGRU_DBPASSWORD');
$host = getenv('CAMAGRU_HOST');
$port = getenv('CAMAGRU_PORT');

$dsn = "mysql:host=$host:$port;dbname=$dbname";
$pdo = new PDO($dsn, $user, $passwd);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>