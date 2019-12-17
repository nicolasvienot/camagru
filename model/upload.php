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
    $sql = "INSERT INTO images (img_path, user_id, user_login) VALUES (:img_path, :user_id, :user_login)";
    $st = $pdo->prepare($sql);
    $st->bindParam(':img_path', $img_path);
    $st->bindParam(':user_login', $user_login);
    $st->bindParam(':user_id', $user_id);
    $st->execute();

    $sql = "SELECT img_id FROM images WHERE img_path=:img_path";
    $st = $pdo->prepare($sql);
    $st->bindParam(':img_path', $img_path);
    $st->execute();
    $data_img = $st->fetch();
    $img_id = $data_img['img_id'];
    $pdo = null;
    return $img_id;
}

function get_own_images($user_id) {
    require (__DIR__ . '/../config/database.php');
    try {
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (Exception $e) {
        die("Unsuccessful access to database: $e");
    }
    $sql = "SELECT * FROM images WHERE user_id = :user_id ORDER BY img_id DESC";
    $st = $pdo->prepare($sql);
    $st->bindParam(':user_id', $user_id);
    $st->execute();
	while ($data_img = $st->fetch()) {
        $img_id = $data_img['img_id'];
        $img_path = $data_img['img_path'];
        // $gallery = $gallery . ('<img src="../' . $img_path .'" style="height: 240px; width: auto;" id="' . $img_id . '">');

        $mygallery = $mygallery . ('
        <div class="column is-one-quarter-desktop is-half-tablet" id="' . $img_id . '">
            <div class="card-image">
                <figure class="image has-ratio">
                    <img src="../' . $img_path . '">
                </figure>
            </div>
        </div>');

        // $gallery = $gallery . ('<img height=240px width=320px src="../' . $img_path .'">');
    }
    $pdo = null;
    return $mygallery;
}

function delete_image_db($img_id)
{
    require (__DIR__ . '/../config/database.php');
    try {
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (Exception $e) {
        die("Unsuccessful access to database: $e");
    }
    $sql = "SELECT img_path FROM images WHERE img_id=:img_id";
    $st = $pdo->prepare($sql);
    $st->bindParam(':img_id', $img_id);
    $st->execute();
    $data_img = $st->fetch();
    if ($data_img == null)
    {
        return 0;
    }
    $img_path = $data_img['img_path'];

    $sql = "DELETE FROM images WHERE img_id=:img_id";
    $st = $pdo->prepare($sql);
    $st->bindParam(':img_id', $img_id);
    $st->execute();
    $pdo = null;
    return $img_path;
}

?>