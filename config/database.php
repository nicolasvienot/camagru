<?php

$DB_NAME = getenv('CAMAGRU_DBNAME');
$DB_USER = getenv('CAMAGRU_DBUSER');
$DB_PASSWORD = getenv('CAMAGRU_DBPASSWORD');
$DB_HOST = getenv('CAMAGRU_DBHOST') ?: 'localhost';
$DB_PORT = getenv('CAMAGRU_DBPORT') ?: '3306';
$DB_DSN_NOBASE = "mysql:host=$DB_HOST:$DB_PORT";
$DB_DSN = "mysql:host=$DB_HOST:$DB_PORT;dbname=$DB_NAME";
$ROOT = getenv('CAMAGRU_ROOT') ?: 'http://localhost:8080/';
