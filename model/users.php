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
    send_mail($email, $login, $user_key);
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

function send_mail($email, $login, $user_key)
{
    $subject = "Activate your Camagru account";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: <nvienot@student.42.fr>' . "\r\n";
    $message = 'Welcome on Camagru,
    In order to activate your account, please click on the link below
    or copy/paste it in your browser. <br/>
    http://localhost/activation.php?log='.urlencode($login).'&key='.urlencode($user_key).' <br/>
    -------------- <br/>
    This is an automated message - Please do not reply directly to this email.';
    mail($email, $subject, $message, $headers);
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

?>