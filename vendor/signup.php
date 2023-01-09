<?php

require_once "Autoloader.php";

Autoloader::register();

use Service\DefaultUserService;
use Model\User;

session_start();

$userService = DefaultUserService::getInstance();

$user = new User($_POST['username'], $_POST['password'], $_POST['sub_password'],
    $_POST['email'], $_POST['name']);

$result = $userService->registration($user);

echo json_encode($result->getBody());



