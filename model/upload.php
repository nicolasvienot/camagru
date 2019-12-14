<?php

function upload_img($img_path, $user_login, $user_id) {
    require (__DIR__ . '/../config/database.php');
    try {
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (Exception $e) {
        die("Unsuccessful access to database: $e");
    }
    $sql = "INSERT INTO images (img_path, user_id, user_login) VALUES (:img_name, :user_id, :user_login)";
    $st = $pdo->prepare($sql);
    $st->bindParam(':img_name', $img_path);
    $st->bindParam(':user_login', $user_login);
    $st->bindParam(':user_id', $user_id);
    $st->execute();
    $pdo = null;
    // return 1;
}

?>