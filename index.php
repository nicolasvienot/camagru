<?php

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/' :
        require __DIR__ . '/controller/index.php';
        break;
    case '/signin' :
        require __DIR__ . '/controller/users/signin.php';
        break;
    case '/signup' :
        require __DIR__ . '/controller/users/signup.php';
        break;
    case '/upload' :
        require __DIR__ . '/controller/upload.php';
        break;
    case '/modify' :
        require __DIR__ . '/controller/modify.php';
        break;
    case '/logout' :
        require __DIR__ . '/controller/users/logout.php';
        break;
    case '/terms' :
        require __DIR__ . '/view/terms.php';
        break;
    case (preg_match("/^(\/activation.php)/i", $request) ? true : false) :
        $login = htmlentities($_GET["log"]);
        $key = htmlentities($_GET["key"]);
        require __DIR__ . '/controller/users/activation.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/view/404.php';
        break;
}

?>