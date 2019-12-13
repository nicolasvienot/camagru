<?php

include 'database.php';

echo "Initialization of the CAMAGRU database...<br/><br/>";

$pdo = new PDO($DB_DSN_NOBASE, $DB_USER, $DB_PASSWORD);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

echo "Creating database...<br/>";
$sql = "CREATE DATABASE IF NOT EXISTS $DB_NAME;";
$ret = $pdo->exec($sql);
echo "Database camagru created!<br/>";

$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

echo "Creating table users...<br/>";
$sql = "CREATE TABLE IF NOT EXISTS users (
    user_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    user_login VARCHAR(255) NOT NULL,
    user_password VARCHAR(64) NOT NULL,
    user_email VARCHAR(255) NOT NULL,
    user_key VARCHAR(32) NOT NULL,
    user_active INT(1) DEFAULT '0',
    notifications INT(1) DEFAULT '1'
    )";
$ret = $pdo->exec($sql);
echo "Table user created!<br/>";

echo "Creating table images...<br/>";
$sql = "CREATE TABLE IF NOT EXISTS images (
    img_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    img_name VARCHAR(255) NOT NULL,
    user_id INT(6) NOT NULL,
    user_login VARCHAR(255) NOT NULL,
    likes_counter INT(6) DEFAULT '0'
    )";
$ret = $pdo->exec($sql);
echo "Table images created!<br/>";

echo "Creating table likes...<br/>";
$sql = "CREATE TABLE IF NOT EXISTS likes (
    like_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(6) NOT NULL,
    img_id INT(6) NOT NULL
    )";
$ret = $pdo->exec($sql);
echo "Table likes created!<br/>";

echo "Creating table comments...<br/>";
$sql = "CREATE TABLE IF NOT EXISTS comments (
    comment_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(6) NOT NULL,
    img_id INT(6) NOT NULL,
    comment_content TEXT NOT NULL
    )";
$ret = $pdo->exec($sql);
echo "Table comments created!<br/><br/>";

echo "Database CAMAGRU has been succesfully initialized! Congratulation<br/>";
$pdo = null;

?>