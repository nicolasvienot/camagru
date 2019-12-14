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

        $sql = "SELECT user_login FROM users WHERE user_id = :user_id";
        $st2 = $pdo->prepare($sql);
        $st2->bindParam(':user_id', $data_img['user_id'], PDO::PARAM_INT);
        $st2->execute();

        $data_user = $st2->fetch();
        $login = $data_user['user_login'];
        $gallery = $gallery . ('
        <div class="column is-one-quarter-desktop is-half-tablet">
            <strong>John Smith</strong> <small>@'. $login .'</small> <small>31m</small>
            <div class="card-image">
                <figure class="image has-ratio">
                    <img src="' . $img_path . '" alt="' . $img_id . '">
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
                            <span class="icon is-small"><i class="fas fa-heart"></i></span>
                        </a>
                        <a class="level-item">
                            '. $login .'
                        </a>
                    </div>
                </nav>
            </div>
        </div>');
    }
    return $gallery;
}

?>