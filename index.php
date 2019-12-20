<?php

require (__DIR__ . '/config/database.php');
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
if ($st->fetch() == "")
{
    require __DIR__ . '/view/db.php';
    return;
}

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/' :
        require __DIR__ . '/controller/index.php';
        break;
    case '/signin/' :
        require __DIR__ . '/controller/users/signin.php';
        break;
    case '/signup/' :
        require __DIR__ . '/controller/users/signup.php';
        break;
    case '/upload/' :
        require __DIR__ . '/controller/upload.php';
        break;
    case '/modifyaccount/' :
        require __DIR__ . '/controller/users/modifyaccount.php';
        break;
    case '/logout/' :
        require __DIR__ . '/controller/users/logout.php';
        break;
    case '/terms/' :
        require __DIR__ . '/view/terms.php';
        break;
    case '/404/' :
        require __DIR__ . '/view/404.php';
        break;
    case '/404/' :
        require __DIR__ . '/view/404.php';
        break;
    case (preg_match("/^(\/activation.php)/i", $request) ? true : false) :
        $login = htmlentities($_GET["log"]);
        $key = htmlentities($_GET["key"]);
        require __DIR__ . '/controller/users/activation.php';
        break;
    case (preg_match("/^(\/comments\/)/i", $request) ? true : false) :
        $img_id = $_GET["img_id"];
        require __DIR__ . '/controller/comments.php';
        break;
    case (preg_match("/^(\/resetpassword.php)/i", $request) ? true : false) :
        $reset_key = htmlentities($_GET["keyreset"]);
        require __DIR__ . '/controller/users/resetpassword.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/view/404.php';
        break;
}

?>