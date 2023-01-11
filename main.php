<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require "vendor/autoload.php";

session_start();
if (!$_SESSION['user']) {
    header('Location: index.php');
}

$loader = new FilesystemLoader('views');
$twig = new Environment($loader);

if (isset($_SESSION['user']['name'])) {
    echo $twig->render('main.twig', array(
        'username' => $_SESSION['user']['name']
    ));
}

