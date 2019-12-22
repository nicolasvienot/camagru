<?php

function check_db() {
    require (__DIR__ . '/../config/database.php');
    try {
        $pdo = new PDO($DB_DSN_NOBASE, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (Exception $e) {
        die("Unsuccessful access to database: $e");
    }
    $sql = "SHOW DATABASES LIKE 'camagru'";
    $st = $pdo->prepare($sql);
    $st->execute();
    $res = $st->fetch();
    return ($res);
}

?>