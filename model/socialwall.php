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
        $img_date = $data_img['img_date'];

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
        $present_id = $_SESSION['user_id'];
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

        $gallery = $gallery.('
        <div class="column is-one-quarter-desktop is-half-tablet">
            <strong>@'.$login.'</strong> <small>'.$img_date.'</small>
            <div class="card-image">
                <figure class="image has-ratio">
                    <img src="'.$img_path.'" id="'.$img_id.'">
                </figure>
                <div class="card-content is-overlay is-clipped">
                    <span class="tag is-info">@'.$login.'</span>   
                </div>
                <nav class="level is-mobile">
                    <div class="level-left">
                        <a class="level-item">
                            <span class="icon is-small"><i class="fas fa-comment"></i></span>
                        </a>
                        <a class="level-item">
                            <span class="icon is-small"><i class="fas fa-retweet"></i></span>
                        </a>
                        <a class="level-item">
                            <span class="icon is-small'.$user_liked.'"><i class="fas fa-heart"></i></span>
                            <span> '.$nblikes.'</span>
                        </a>
                        <a class="level-item">
                            '.$login.'
                        </a>
                    </div>
                </nav>
            </div>
        </div>');
    }
    $pdo = null;
    return $gallery;
}

function get_image($img_id) {
    require (__DIR__ . '/../config/database.php');
    try {
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (Exception $e) {
        die("Unsuccessful access to database: $e");
    }

    // $sql = "SELECT COUNT(*) FROM images WHERE img_id = :img_id";
    // $st = $pdo->prepare($sql);
    // $st->bindParam(':img_id', $img_id, PDO::PARAM_INT);
    // $st->execute();
    // $data_img = $st->fetch();
    // if ($data_img['COUNT(*)'] != 1) {
    //     return 0;
    // }

    $sql = "SELECT * FROM images WHERE img_id = :img_id";
    $st = $pdo->prepare($sql);
    $st->bindParam(':img_id', $img_id, PDO::PARAM_INT);
    $st->execute();
    $data_img = $st->fetch();
    if ($data_img == null)
    {
        return 0;
    }
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
    $present_id = $_SESSION['user_id'];
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

    $image = ('
            <figure class="image has-ratio" id="img_container">
                <img src="../'.$img_path.'" style="max-width: 640px;" id="'.$img_id.'">
            </figure>
            <div class="card-content is-overlay is-clipped">
                <span class="tag is-info">@'.$login.'</span>   
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
                        <span class="icon is-small'.$user_liked.'"><i class="fas fa-heart"></i></span>
                        <span> '.$nblikes.'</span>
                    </a>
                    <a class="level-item">
                        '.$login.'
                    </a>
                </div>
            </nav>');
    $pdo = null;
    return $image;
}

function manage_likes($img_id, $user_id) 
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
        $st->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $st->bindValue(':img_id', $img_id, PDO::PARAM_INT);
        $st->execute();
        $res = 2;
    }
    else
    {
        $sql = "INSERT INTO likes (user_id, img_id) VALUES (:user_id, :img_id)";
        $st = $pdo->prepare($sql);
        $st->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $st->bindValue(':img_id', $img_id, PDO::PARAM_INT);
        $st->execute();
        $res = 1;
    }
    $pdo = null;
    return $res;
}

function get_comments($img_id) {
    require (__DIR__ . '/../config/database.php');
    try {
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (Exception $e) {
        die("Unsuccessful access to database: $e");
    }
    $sql = "SELECT * FROM comments WHERE img_id = :img_id ORDER BY comment_id DESC";
    $st = $pdo->prepare($sql);
    $st->bindValue(':img_id', $img_id, PDO::PARAM_INT);
    $st->execute();
	while ($data_comment = $st->fetch()) {
        $comment_id = $data_comment['comment_id'];
        $user_id = $data_comment['user_id'];
        $comment_content = $data_comment['comment_content'];

        $sql = "SELECT user_login FROM users WHERE user_id = :user_id";
        $st2 = $pdo->prepare($sql);
        $st2->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $st2->execute();
        $data_user = $st2->fetch();
        $login = $data_user['user_login'];
        
        if ($login === $_SESSION['user'])
        {
            $button_suppr = '<a class="delete is-small" id="delete_comment"></a>';
        }
        else
        {
            $button_suppr = '';
        }

        $comments = $comments . ('<div id="'.$comment_id.'"><p>
            <strong>'.$login.'</strong> <small>@'.$login.'</small> <small>31m</small>
            '.$button_suppr.'
            <br>
            '.$comment_content.'
        </p></div>');
    }
    $pdo = null;
    return $comments;
}

function add_comment($img_id, $user_id, $comment_content) 
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
    $sql = "INSERT INTO comments (user_id, img_id, comment_content) VALUES (:user_id, :img_id, :comment_content)";
    $st = $pdo->prepare($sql);
    $st->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $st->bindValue(':img_id', $img_id, PDO::PARAM_INT);
    $st->bindValue(':comment_content', $comment_content, PDO::PARAM_STR);
    if ($st->execute())
        $res = 1;
    $pdo = null;
    return $res;
}

function delete_comment($comment_id, $user_id) 
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

    $sql = "SELECT * FROM comments WHERE comment_id = :comment_id";
    $st = $pdo->prepare($sql);
    $st->bindValue(':comment_id', $comment_id, PDO::PARAM_INT);
    $st->execute();
    $data_comment = $st->fetch();
    if ($data_comment === null)
        $res = 0;
    else if ($data_comment['user_id'] !== $user_id)
        $res = 2;
    else {
        $sql = "DELETE FROM comments WHERE comment_id = :comment_id";
        $st = $pdo->prepare($sql);
        $st->bindValue(':comment_id', $comment_id, PDO::PARAM_INT);
        if ($st->execute())
            $res = 1;
    }
    $pdo = null;
    return $res;
}

?>