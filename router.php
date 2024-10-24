<?php
require_once __DIR__ . '/config.php';
$filename = '';
$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/':
        require __DIR__ . '/public/index.php';
        break;
    case '/logout':
        require __DIR__ . '/app/validation/logout.php';
        break;
    case '/Valregister':
        require __DIR__ . '/app/validation/register.php';
        break;
    case 'sidebarAdmin':
        require __DIR__ . '/resources/includes/sidebarAdmin.php';
        break;
    default:
        $filename = __DIR__ . "/public" . $request . ".php";
        $visitorFile = __DIR__ . "/resources/visitor" . $request . ".php";
        $includeFile = __DIR__ . "/resources/includes" . $request . ".php";
        $adminFile = __DIR__ . "/resources/admin" . $request . ".php";
        if (file_exists($filename)) {
            require $filename;
            break;
        }
        if (file_exists($visitorFile)) {
            require $visitorFile;
            break;
        }
        if (file_exists($includeFile)) {
            require $includeFile;
            break;
        }if (file_exists($adminFile)) {
            require $adminFile;
            break;
        }
        http_response_code(404);
        require __DIR__ . '/public/404.php';
        break;
}
