<?php
require_once "Autoloader.php";

Autoloader::register();

use Storage\UserStorage;
use Validation\UserValidation;

session_start();
$userStorage = new UserStorage();
$validator = new UserValidation();

$username = $_POST['username'];
$password = $_POST['password'];

$userStorage->login($username, $password);
