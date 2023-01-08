<?php

require_once "Autoloader.php";

Autoloader::register();

use Storage\UserStorage;
use Validation\UserValidation;
use Model\User;

session_start();

$userStorage = new UserStorage();
$validator = new UserValidation();

$user = new User($_POST['username'], $_POST['password'], $_POST['sub_password'],
    $_POST['email'], $_POST['name']);

if ($validator->validateUser($user)) {
    $userStorage->insertUser($user);
}