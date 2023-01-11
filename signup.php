<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require "vendor/autoload.php";

$loader = new FilesystemLoader('views');
$twig = new Environment($loader);

session_start();
if ($_SESSION['user']) {
    header('Location: main.php');
}

echo $twig->render('signup.twig');