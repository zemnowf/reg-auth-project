<?php
require ('user_storage.class.php');
require ('validation.php');
require_once ('user.class.php');

session_start();

$userStorage = new UserStorage();
$validator = new Validator();

$user = new User($_POST['username'], $_POST['password'], $_POST['sub_password'],
    $_POST['email'], $_POST['name']);

if($validator->validateUser($user)){
    $userStorage->insertUser($user);
}