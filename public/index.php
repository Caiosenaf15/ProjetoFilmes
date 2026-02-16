<?php 
session_set_cookie_params([
    'httponly' => true,
    'secure' => false,
    'samesite' => 'Strict'
]);
session_start();
$url = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

require_once "../../routes/web.php";
?>