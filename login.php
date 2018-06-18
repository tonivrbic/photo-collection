<?php 
session_start(); 
if($_SESSION && $_SESSION['logged']){ 
    header("Location: index.php"); 
    exit; 
} 
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="blue-bg">
    <div class="box-wrapper">
        <h1 class="title">Photo Collection</h1>
        <form action="verify_login.php" method="post" class="form-box">
            <h2>Log in here</h2>
            <input type="text" name="username" class="input" placeholder="Username"><br><br> 
            <input type="password" name="password" class="input" placeholder="Password"><br><br> 
            <input type="submit" name="submit" value="Login" class="button"> 
            <br>
            <a href="register.php">Don't have an account? Registere here.</a>
        </form> 
    </div>
</form> 
</body>
</html>
