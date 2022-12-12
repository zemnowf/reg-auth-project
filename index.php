<?php
session_start();
if(isset($_SESSION['user'])){
    header('Location: main.php');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Authorization</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
<form>
    <p class="success"></p>
    <h2>Authorization</h2>
    <label>Login</label>
    <input type="text" id="username" name="username">
    <label>Password</label>
    <input type="password" id="password" name="password">
    <button type="submit" class="login-btn">Sign in!</button>
    <p>
        <a href="signup.php">Sign in</a>
    </p>
    <p class="error" id="error"></p>
</form>
<script src="assets/js/jquery.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>