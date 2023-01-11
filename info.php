<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require "vendor/autoload.php";

$loader = new FilesystemLoader('views');
$twig = new Environment($loader);

session_start();
if (!$_SESSION['user']) {
    header('Location: index.php');
} else {
    echo $twig->render('info.twig', array(
        'username' => $_SESSION['user']['username'],
        'name' => $_SESSION['user']['name'],
        'email' => $_SESSION['user']['email']
    ));
}