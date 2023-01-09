<?php
require_once "Autoloader.php";

Autoloader::register();

use Service\DefaultUserService;

session_start();
$userService = DefaultUserService::getInstance();

$username = $_POST['username'];
$password = $_POST['password'];

$result = $userService->login($username, $password);

if (!$result->getSuccess()){
    echo json_encode($result->getBody());
} else {
    $_SESSION['user'] = $result->getBody();
    echo json_encode(["status" => true]);
}
