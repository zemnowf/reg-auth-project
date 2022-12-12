<?php
    require ('user_storage.class.php');
    require ('validation.php');
    require_once ('user.class.php');

    session_start();
    $userStorage = new UserStorage();
    $validator = new Validator();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $userStorage->login($username, $password);
