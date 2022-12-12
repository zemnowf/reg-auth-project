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
    <h2>Hello, <?php if(isset($_SESSION['user']['name'])){
            echo $_SESSION['user']['name'];} ?></h2>
    <a href="info.php">Information</a>
    <a href="vendor/logout.php">Log out</a>
</div>
</body>
</html>