<?php

function get_images() {
    require (__DIR__ . '/../config/database.php');
    try {
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (Exception $e) {
        die("Unsuccessful access to database: $e");
    }
    $sql = "SELECT * FROM images ORDER BY img_id DESC";
    $st = $pdo->prepare($sql);
    $st->execute();
	while ($data_img = $st->fetch()) {
        $img_id = $data_img['img_id'];
        $img_path = $data_img['img_path'];
        $user_id = $data_img['user_id'];

        $sql = "SELECT user_login FROM users WHERE user_id = :user_id";
        $st2 = $pdo->prepare($sql);
        $st2->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $st2->execute();
        $data_user = $st2->fetch();
        $login = $data_user['user_login'];

        $sql = "SELECT COUNT(*) FROM likes WHERE img_id = :img_id";
        $st3 = $pdo->prepare($sql);
        $st3->bindValue(':img_id', $img_id, PDO::PARAM_INT);
        $st3->execute();
        $data_likes = $st3->fetch();
        $nblikes = $data_likes['COUNT(*)'];

        $sql = "SELECT COUNT(*) FROM likes WHERE img_id = :img_id AND user_id = :user_id";
        $st4 = $pdo->prepare($sql);
        $present_id = $_SESSION[user_id];
        $st4->bindValue(':img_id', $img_id, PDO::PARAM_INT);
        $st4->bindParam(':user_id', $present_id, PDO::PARAM_INT);
        $st4->execute();
        $data_likes = $st4->fetch();
        if ($data_likes['COUNT(*)'] != 0)
        {
            $user_liked = " has-text-danger";
        }
        else
        {
            $user_liked = "";
        }

        $gallery = $gallery . ('
        <div class="column is-one-quarter-desktop is-half-tablet">
            <strong>John Smith</strong> <small>@'. $login .'</small> <small>31m</small>
            <div class="card-image">
                <figure class="image has-ratio">
                    <img src="' . $img_path . '" id="' . $img_id . '">
                </figure>
                <div class="card-content is-overlay is-clipped">
                    <span class="tag is-info">@'. $login .'</span>   
                </div>
                <nav class="level is-mobile">
                    <div class="level-left">
                        <a class="level-item">
                            <span class="icon is-small"><i class="fas fa-reply"></i></span>
                        </a>
                        <a class="level-item">
                            <span class="icon is-small"><i class="fas fa-retweet"></i></span>
                        </a>
                        <a class="level-item">
                            <span class="icon is-small' . $user_liked . '"><i class="fas fa-heart"></i></span>
                            <span> ' . $nblikes . '</span>
                        </a>
                        <a class="level-item">
                            '. $login .'
                        </a>
                    </div>
                </nav>
            </div>
        </div>');
    }
    $pdo = null;
    return $gallery;
}

function manage_like($img_id, $user_id) 
{
    $res = 0;
    require (__DIR__ . '/../config/database.php');
    try {
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (Exception $e) {
        die("Unsuccessful access to database: $e");
    }
    $sql = "SELECT COUNT(*) FROM likes WHERE user_id = :user_id AND img_id = :img_id";
    $st = $pdo->prepare($sql);
    $st->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    $st->bindValue(':img_id', $img_id, PDO::PARAM_STR);
    $st->execute();
    $likes_data = $st->fetch();
    if ($likes_data['COUNT(*)'] != 0)
    {
        $sql = "DELETE FROM likes WHERE user_id = :user_id AND img_id = :img_id";
        $st = $pdo->prepare($sql);
        $st->bindValue(':user_id', $user_id, PDO::PARAM_STR);
        $st->bindValue(':img_id', $img_id, PDO::PARAM_STR);
        $st->execute();
        $res = 2;
    }
    else
    {
        $sql = "INSERT INTO likes (user_id, img_id) VALUES (:user_id, :img_id)";
        $st = $pdo->prepare($sql);
        $st->bindValue(':user_id', $user_id, PDO::PARAM_STR);
        $st->bindValue(':img_id', $img_id, PDO::PARAM_STR);
        $st->execute();
        $res = 1;
    }
    $pdo = null;
    return $res;
}

?>