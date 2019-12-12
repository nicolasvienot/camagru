<?php

include ('connect.php');

$login = htmlentities($_POST["username"]);
$password = htmlentities(hash('sha256', $_POST["password"]));

$sql = "SELECT user_active, user_id FROM users WHERE user_login like :user_login";
$st = $pdo->prepare($sql);
$st->bindValue(':user_login', $login, PDO::PARAM_STR);
$st->execute();
if ($row = $st->fetch())
{
    $active = $row['user_active'];
    $user_id = $row['user_id'];
}

$sql = "SELECT COUNT(*) FROM users WHERE user_login = :user_login AND user_password = :user_password";
$st = $pdo->prepare($sql);
$st->bindValue(':user_login', $login, PDO::PARAM_STR);
$st->bindValue(':user_password', $password, PDO::PARAM_STR);
$st->execute();
$st = $st->fetch();
if ($st['COUNT(*)'] == 1)
{
    if ($active == '1') {
        session_start();
        $_SESSION['user_logged'] = $login;
        $_SESSION['user_id'] = $user_id;
        echo "user_log_ok";
        return;
        // header("Location: index.php");
    }
    else {
        echo "account not activated";
        return;
    }
}
else {
    echo "connection problem";
    return;
}

// if (((isset($_POST['login']) && empty($_POST['login']) && isset($_POST['password']) && $_POST['submit'] == "Login")) || (isset($_POST['password']) && empty($_POST['password']) && isset($_POST['login']) && $_POST['submit'] == "Login")) {
//     echo "need mor intells";
// }


//attention
$pdo = null;

echo ("wtf");

// ?>