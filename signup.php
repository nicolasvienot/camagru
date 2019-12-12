<?php

include ('connect.php');

$login = htmlentities($_POST["login"]);
$email = htmlentities($_POST["email"]);
$password = htmlentities($_POST["password"]);
$password_check = htmlentities($_POST["password_check"]);
$terms = htmlentities($_POST["terms"]);
$user_key = md5(microtime(TRUE)*100000);

// test email + pass or pass or mail?

if ($terms !== "on")
{
    echo ("problem terms");
    return;
}

$sql = "SELECT COUNT(*) FROM users WHERE user_login = :user_login";
$st = $pdo->prepare($sql);
$st->bindValue(':user_login', $login, PDO::PARAM_STR);
$st->execute();
$st = $st->fetch();
if ($st['COUNT(*)'] != 0)
{
    echo ("problem user");
    return;
}

$sql = "SELECT COUNT(*) FROM users WHERE user_email = :user_email";
$st = $pdo->prepare($sql);
$st->bindValue(':user_email', $email, PDO::PARAM_STR);
$st->execute();
$st = $st->fetch();
if ($st['COUNT(*)'] != 0)
{
    echo ("problem email");
    return;
}

if ($password !== $password_check)
{
    echo ("problem password");
    return;
}

$password = hash("sha256", $password);

if (!filter_var($email, FILTER_VALIDATE_EMAIL))
{
    echo ("problem email filter");
    return;
}

// check longueur des trucs
// check mdp
// filter_var -> mail

$sql = "INSERT INTO users (user_login, user_password, user_email, user_key) VALUES (:user_login, :user_password, :user_email, :user_key)";
$st = $pdo->prepare($sql);
$st->bindParam(':user_login', $login);
$st->bindParam(':user_password', $password);
$st->bindParam(':user_email', $email);
$st->bindParam(':user_key', $user_key);
$st->execute();

//attention
$conn = null;

echo ("goodjob");

?>