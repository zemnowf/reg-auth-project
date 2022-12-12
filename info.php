<?php
session_start();
if(!$_SESSION['user']){
    header('Location: index.php');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Main Page</title>
</head>
<body>
<div class="main">
    <p>
        Information about <?php if(isset($_SESSION['user']['username'])){
            echo $_SESSION['user']['username'];} ?>
    </p>
    <p>Name: <?php if(isset($_SESSION['user']['name'])){
            echo $_SESSION['user']['name'];} ?></p>
    <p>
        Username: <?php if(isset($_SESSION['user']['username'])){
            echo $_SESSION['user']['username'];} ?>
    </p>
    <p>
        Email: <?php if(isset($_SESSION['user']['email'])){
            echo $_SESSION['user']['email'];} ?>
    </p>
    <a href="main.php">Main</a>
    <a href="vendor/logout.php">Log out</a>
</div>
</body>
</html>