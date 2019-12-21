<?php

function signin($login, $password) {
    require (__DIR__ . '/../config/database.php');
    $res = 0;

    $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT COUNT(*) FROM users WHERE user_login = :user_login AND user_password = :user_password";
    $st = $pdo->prepare($sql);
    $st->bindValue(':user_login', $login, PDO::PARAM_STR);
    $st->bindValue(':user_password', $password, PDO::PARAM_STR);
    $st->execute();
    $st = $st->fetch();
    if ($st['COUNT(*)'] == 1)
    {
        $sql = "SELECT user_active, user_id FROM users WHERE user_login like :user_login";
        $st = $pdo->prepare($sql);
        $st->bindValue(':user_login', $login, PDO::PARAM_STR);
        $st->execute();
        if ($row = $st->fetch())
        {
            $active = $row['user_active'];
            $user_id = $row['user_id'];
        }
        if ($active == '1') {
            session_start();
            $_SESSION['user'] = $login;
            $_SESSION['user_id'] = $user_id;
            $res = 1;
        }
        else {
            $res = 2;
        }
    }
    else {
        $res = 3;
    }
    $pdo = null;
    return $res;
}

function signup($login, $password, $email) {
    require (__DIR__ . '/../config/database.php');
    // $res = 0;
    // $user_key = uniqid(TRUE);
    $user_key = md5(microtime(TRUE)*100000);

    $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO users (user_login, user_password, user_email, user_key) VALUES (:user_login, :user_password, :user_email, :user_key)";
    $st = $pdo->prepare($sql);
    $st->bindParam(':user_login', $login);
    $st->bindParam(':user_password', $password);
    $st->bindParam(':user_email', $email);
    $st->bindParam(':user_key', $user_key);
    $st->execute();
    send_mail_activation($email, $login, $user_key);
    $pdo = null;
    return 1;
}

function user_exists($login) {
    require (__DIR__ . '/../config/database.php');
    $res = 0;

    $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT COUNT(*) FROM users WHERE user_login = :user_login";
    $st = $pdo->prepare($sql);
    $st->bindValue(':user_login', $login, PDO::PARAM_STR);
    $st->execute();
    $st = $st->fetch();
    if ($st['COUNT(*)'] != 0)
        $res = 1;
    $pdo = null;
    return $res;
}

function email_exists($email) {
    require (__DIR__ . '/../config/database.php');
    $res = 0;

    $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT COUNT(*) FROM users WHERE user_email = :user_email";
    $st = $pdo->prepare($sql);
    $st->bindValue(':user_email', $email, PDO::PARAM_STR);
    $st->execute();
    $st = $st->fetch();
    if ($st['COUNT(*)'] != 0)
        $res = 1;
    $pdo = null;
    return $res;
}

function send_mail_activation($email, $login, $user_key)
{
    $subject = "Activate your Camagru account";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: Camagru <noreply@camagru.com>' . "\r\n";
    $link = 'http://localhost:8080/activation.php?log='.urlencode($login).'&key='.urlencode($user_key);
    $path = (__DIR__ . '/../public/html/templates/mail_activation.html');
    $template = file_get_contents($path);
    $template = str_replace('{{ link }}', $link, $template);
    $message = str_replace('{{ login }}', $login, $template);
    mail($email, $subject, $message, $headers);
}

function send_mail_forgot($user_email, $reset_key)
{
    $subject = "Reset your Camagru password";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: Camagru <noreply@camagru.com>' . "\r\n";
    $link = 'http://localhost:8080/resetpassword.php?&keyreset='.urlencode($reset_key);
    $path = (__DIR__ . '/../public/html/templates/mail_resetpassword.html');
    $template = file_get_contents($path);
    $message = str_replace('{{ link }}', $link, $template);
    mail($user_email, $subject, $message, $headers);
}

function activate_account($login, $key) {
    require (__DIR__ . '/../config/database.php');
    $res = 0;

    $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT user_key, user_active FROM users WHERE user_login like :user_login ";
    $st = $pdo->prepare($sql);
    $st->bindValue(':user_login', $login, PDO::PARAM_STR);
    $st->execute();
    // $st = $st->fetch();
    if ($row = $st->fetch())
    {
        $user_key = $row['user_key'];
        $user_active = $row['user_active'];
        if ($user_active == '1') {
            $res = 2;
        }
        else {
            if ($key == $user_key) {
                $sql = "UPDATE users SET user_active = 1 WHERE user_login like :user_login";
                $st = $pdo->prepare($sql);
                $st->bindParam(':user_login', $login);
                $st->execute();
                $res = 1;
            }
            else {
                $res = 3;
            }
        }
    }
    else {
        $res = 4;
    }
    $pdo = null;
    return $res;
}

function send_forgot($user_email) {
    // $res = 0;
    require (__DIR__ . '/../config/database.php');
    try {
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (Exception $e) {
        die("Unsuccessful access to database: $e");
    }

    
    $sql = "SELECT * FROM users WHERE user_email like :user_email";
    $st = $pdo->prepare($sql);
    $st->bindValue(':user_email', $user_email, PDO::PARAM_STR);
    if (!$st->execute())
        return 2;
    $data_user = $st->fetch();
    if ($data_user == null)
        return 3;
    $user_id = $data_user['user_id'];

    
    $sql = "SELECT COUNT(*) FROM resets WHERE user_id = :user_id";
    $st = $pdo->prepare($sql);
    $st->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $st->execute();
    $data_reset = $st->fetch();
    if ($data_reset['COUNT(*)'] != 0) {
        $sql = "DELETE FROM resets WHERE user_id=:user_id";
        $st = $pdo->prepare($sql);
        $st->bindParam(':user_id', $user_id);
        $st->execute();
    }

    $reset_key = md5(microtime(TRUE)*mt_rand(1, 12345));

    $sql = "INSERT INTO resets (user_id, reset_key) VALUES (:user_id, :reset_key)";
    $st = $pdo->prepare($sql);
    $st->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $st->bindValue(':reset_key', $reset_key, PDO::PARAM_STR);
    $st->execute();
    send_mail_forgot($user_email, $reset_key);
    $pdo = null;
    return 1;
}

function check_reset_password($reset_key)
{
    require (__DIR__ . '/../config/database.php');
    try {
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (Exception $e) {
        die("Unsuccessful access to database: $e");
    }
    $sql = "SELECT COUNT(*) FROM resets WHERE reset_key like :reset_key";
    $st = $pdo->prepare($sql);
    $st->bindValue(':reset_key', $reset_key, PDO::PARAM_STR);
    $st->execute();
    $data_reset = $st->fetch();
    if ($data_reset['COUNT(*)'] != 1) {
        return 2;
    }
    else
    {
        // $sql = "SELECT COUNT(*) FROM resets WHERE reset_key like :reset_key AND WHERE ts < NOW() - INTERVAL 1 DAY";
        // $st = $pdo->prepare($sql);
        // $st->bindValue(':reset_key', $reset_key, PDO::PARAM_STR);
        // $st->execute();
        // $data_reset = $st->fetch();
        // if ($data_reset['COUNT(*)'] != 1)
        //     return 2;
        // else
            return 1;
    }
    return 1;
}


function reset_password($password, $key)
{
    require (__DIR__ . '/../config/database.php');
    try {
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (Exception $e) {
        die("Unsuccessful access to database: $e");
    }

    $sql = "SELECT user_id FROM resets WHERE reset_key like :reset_key";
    $st = $pdo->prepare($sql);
    $st->bindValue(':reset_key', $key, PDO::PARAM_STR);
    $st->execute();
    $data_reset = $st->fetch();
    if ($data_reset == null)
        return 0;
    $user_id = $data_reset['user_id'];

    $sql = "UPDATE users SET user_password = :user_password WHERE user_id = :user_id";
    $st = $pdo->prepare($sql);
    $st->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $st->bindParam(':user_password', $password, PDO::PARAM_STR);
    if ($st->execute())
    {
        $sql = "DELETE FROM resets WHERE user_id=:user_id";
        $st = $pdo->prepare($sql);
        $st->bindParam(':user_id', $user_id);
        $st->execute();
        return 1;
    }
    return 6;
}


// function reset_password($key, $id) {
//     require (__DIR__ . '/../config/database.php');
//     try {
//         $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
//         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     }
//     catch (Exception $e) {
//         die("Unsuccessful access to database: $e");
//     }

//     $sql = "SELECT user_id, user_active FROM users WHERE user_login like :user_login ";
//     $st = $pdo->prepare($sql);
//     $st->bindValue(':user_login', $login, PDO::PARAM_STR);
//     $st->execute();
//     // $st = $st->fetch();
//     if ($row = $st->fetch())
//     {
//         $user_key = $row['user_key'];
//         $user_active = $row['user_active'];
//         if ($user_active == '1') {
//             $res = 2;
//         }
//         else {
//             if ($key == $user_key) {
//                 $sql = "UPDATE users SET user_active = 1 WHERE user_login like :user_login";
//                 $st = $pdo->prepare($sql);
//                 $st->bindParam(':user_login', $login);
//                 $st->execute();
//                 $res = 1;
//             }
//             else {
//                 $res = 3;
//             }
//         }
//     }
//     else {
//         $res = 4;
//     }
//     $pdo = null;
//     return $res;
// }


function modify_username($new_login, $login, $user_id)
{
    require (__DIR__ . '/../config/database.php');
    try {
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (Exception $e) {
        die("Unsuccessful access to database: $e");
    }

    $sql = "SELECT COUNT(*) FROM users WHERE user_id = :user_id AND user_login = :user_login";
    $st = $pdo->prepare($sql);
    $st->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $st->bindParam(':user_login', $login, PDO::PARAM_STR);
    $st->execute();
    $data_user = $st->fetch();
    if ($data_user['COUNT(*)'] != 1) {
        return 0;
    }
    $sql = "UPDATE users SET user_login = :user_login WHERE user_id = :user_id";
    $st = $pdo->prepare($sql);
    $st->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $st->bindParam(':user_login', $new_login, PDO::PARAM_STR);
    if ($st->execute())
    {
        session_start();
        $_SESSION['user'] = $new_login;
        $_SESSION['user_id'] = $user_id;
        return 1;
    }
    return 0;
}

function modify_email($new_email, $login, $user_id)
{
    require (__DIR__ . '/../config/database.php');
    try {
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (Exception $e) {
        die("Unsuccessful access to database: $e");
    }

    $sql = "SELECT COUNT(*) FROM users WHERE user_id = :user_id AND user_login = :user_login";
    $st = $pdo->prepare($sql);
    $st->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $st->bindParam(':user_login', $login, PDO::PARAM_STR);
    $st->execute();
    $data_user = $st->fetch();
    if ($data_user['COUNT(*)'] != 1) {
        return 0;
    }
    $sql = "UPDATE users SET user_email = :user_email WHERE user_id = :user_id";
    $st = $pdo->prepare($sql);
    $st->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $st->bindParam(':user_email', $new_email, PDO::PARAM_STR);
    if ($st->execute())
        return 1;
    return 0;
}

function modify_password($old_password, $new_password, $login, $user_id)
{
    require (__DIR__ . '/../config/database.php');
    try {
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (Exception $e) {
        die("Unsuccessful access to database: $e");
    }

    $sql = "SELECT COUNT(*) FROM users WHERE user_login = :user_login AND user_password = :user_password AND user_id = :user_id";
    $st = $pdo->prepare($sql);
    $st->bindValue(':user_login', $login, PDO::PARAM_STR);
    $st->bindValue(':user_password', $old_password, PDO::PARAM_STR);
    $st->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $st->execute();
    $st = $st->fetch();
    if ($st['COUNT(*)'] == 1)
    {
        $sql = "UPDATE users SET user_password = :user_password WHERE user_id = :user_id";
        $st = $pdo->prepare($sql);
        $st->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $st->bindParam(':user_password', $new_password, PDO::PARAM_STR);
        if ($st->execute())
            $res = 1;
        else
            $res = 2;
    }
    else 
        $res = 3;
    $pdo = null;
    return $res;
}

function modify_notification($user_id, $user_notification)
{
    require (__DIR__ . '/../config/database.php');
    try {
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (Exception $e) {
        die("Unsuccessful access to database: $e");
    }

    $sql = "SELECT COUNT(*) FROM users WHERE user_id = :user_id";
    $st = $pdo->prepare($sql);
    $st->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $st->execute();
    $data_user = $st->fetch();
    if ($data_user['COUNT(*)'] != 1) {
        return 0;
    }
    $sql = "UPDATE users SET user_notification = :user_notification WHERE user_id = :user_id";
    $st = $pdo->prepare($sql);
    $st->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $st->bindParam(':user_notification', $user_notification, PDO::PARAM_INT);
    if ($st->execute())
        return 1;
    return 0;
}

function get_user_notif($user_id)
{
    require (__DIR__ . '/../config/database.php');
    try {
        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (Exception $e) {
        die("Unsuccessful access to database: $e");
    }

    $sql = "SELECT user_notification FROM users WHERE user_id = :user_id";
    $st = $pdo->prepare($sql);
    $st->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $st->execute();
    $data_user = $st->fetch();
    if ($data_user == null)
        return 0;
    return $data_user['user_notification'];
}

?>