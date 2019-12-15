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
    img_path VARCHAR(255) NOT NULL,
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
echo "Table likes created!<br/><br/>";

echo "Creating table comments...<br/>";
$sql = "CREATE TABLE IF NOT EXISTS comments (
    comment_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(6) NOT NULL,
    img_id INT(6) NOT NULL,
    comment_content TEXT NOT NULL
    )";
$ret = $pdo->exec($sql);
echo "Table comments created!<br/><br/>";

echo "Creating users...<br/>";
$sql = "INSERT INTO users (user_login, user_password, user_email, user_key, user_active) SELECT :user_login, :user_password, :user_email, :user_key, 1 WHERE NOT EXISTS (SELECT user_login FROM users WHERE user_login = :user_login);";

$st = $pdo->prepare($sql);
$user_login = 'beyonce';
$user_password = hash("sha256", 'bonjour123');
$user_email = 'beyonce@beyonce.com';
$user_key = md5(microtime(TRUE)*100000);
$st->bindParam(':user_login', $user_login);
$st->bindParam(':user_password', $user_password);
$st->bindParam(':user_email', $user_email);
$st->bindParam(':user_key', $user_key);
$st->execute();

$st = $pdo->prepare($sql);
$user_login = 'johnnyhalliday';
$user_password = hash("sha256", 'bonjour123');
$user_email = 'johnny@halliday.fr';
$user_key = md5(microtime(TRUE)*100000);
$st->bindParam(':user_login', $user_login);
$st->bindParam(':user_password', $user_password);
$st->bindParam(':user_email', $user_email);
$st->bindParam(':user_key', $user_key);
$st->execute();

$st = $pdo->prepare($sql);
$user_login = 'rick';
$user_password = hash("sha256", 'bonjour123');
$user_email = 'rick@morty.com';
$user_key = md5(microtime(TRUE)*100000);
$st->bindParam(':user_login', $user_login);
$st->bindParam(':user_password', $user_password);
$st->bindParam(':user_email', $user_email);
$st->bindParam(':user_key', $user_key);
$st->execute();

$st = $pdo->prepare($sql);
$user_login = 'gon_64';
$user_password = hash("sha256", 'bonjour123');
$user_email = 'gon@hunterxhunter.jp';
$user_key = md5(microtime(TRUE)*100000);
$st->bindParam(':user_login', $user_login);
$st->bindParam(':user_password', $user_password);
$st->bindParam(':user_email', $user_email);
$st->bindParam(':user_key', $user_key);
$st->execute();
echo "Users created!<br/><br/>";

echo "Creating images...<br/>";
$sql = "INSERT INTO images (img_path, user_id, user_login) SELECT :img_path, :user_id, :user_login WHERE NOT EXISTS (SELECT img_path FROM images WHERE img_path = :img_path);";

$img_path = 'public/img/uploads/beyonce1.png';
$user_login = 'beyonce';
$user_id = '1';
$st = $pdo->prepare($sql);
$st->bindParam(':img_path', $img_path);
$st->bindParam(':user_id', $user_id);
$st->bindParam(':user_login', $user_login);
$st->execute();

$img_path = 'public/img/uploads/rick1.png';
$user_login = 'rick';
$user_id = '3';
$st = $pdo->prepare($sql);
$st->bindParam(':img_path', $img_path);
$st->bindParam(':user_id', $user_id);
$st->bindParam(':user_login', $user_login);
$st->execute();

$img_path = 'public/img/uploads/rick2.png';
$user_login = 'rick';
$user_id = '3';
$st = $pdo->prepare($sql);
$st->bindParam(':img_path', $img_path);
$st->bindParam(':user_id', $user_id);
$st->bindParam(':user_login', $user_login);
$st->execute();

$img_path = 'public/img/uploads/johnny1.png';
$user_login = 'johnnyhalliday';
$user_id = '2';
$st = $pdo->prepare($sql);
$st->bindParam(':img_path', $img_path);
$st->bindParam(':user_id', $user_id);
$st->bindParam(':user_login', $user_login);
$st->execute();

$img_path = 'public/img/uploads/gon1.png';
$user_login = 'gon';
$user_id = '4';
$st = $pdo->prepare($sql);
$st->bindParam(':img_path', $img_path);
$st->bindParam(':user_id', $user_id);
$st->bindParam(':user_login', $user_login);
$st->execute();

$img_path = 'public/img/uploads/beyonce2.png';
$user_login = 'beyonce';
$user_id = '1';
$st = $pdo->prepare($sql);
$st->bindParam(':img_path', $img_path);
$st->bindParam(':user_id', $user_id);
$st->bindParam(':user_login', $user_login);
$st->execute();


$img_path = 'public/img/uploads/gon2.png';
$user_login = 'gon';
$user_id = '4';
$st = $pdo->prepare($sql);
$st->bindParam(':img_path', $img_path);
$st->bindParam(':user_id', $user_id);
$st->bindParam(':user_login', $user_login);
$st->execute();

$img_path = 'public/img/uploads/johnny2.png';
$user_login = 'johnnyhalliday';
$user_id = '2';
$st = $pdo->prepare($sql);
$st->bindParam(':img_path', $img_path);
$st->bindParam(':user_id', $user_id);
$st->bindParam(':user_login', $user_login);
$st->execute();
echo "Images created!<br/><br/>";

echo "Database CAMAGRU has been succesfully initialized! Congratulation<br/>";

$pdo = null;

?>