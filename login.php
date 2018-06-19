<?php 
session_start(); 
if($_SESSION && $_SESSION['logged']){ 
    header("Location: index.php"); 
    exit; 
} 
$error = FALSE;
if(isset($_POST['submit'])){ 
    include('connection.php');
    
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $usr = mysqli_real_escape_string($conn, $_POST['username']); 
    $sql = mysqli_query($conn, "SELECT * FROM users 
        WHERE username='$usr'
        LIMIT 1"); 
    if(mysqli_num_rows($sql) == 1){ 
        $row = mysqli_fetch_array($sql); 
        if(password_verify($password, $row['password'])){
            session_start();
            $_SESSION['username'] = $row['username'];
            $_SESSION['firstname'] = $row['firstname'];
            $_SESSION['lastname'] = $row['lastname'];
            $_SESSION['logged'] = TRUE; 
            $_SESSION['userId'] = $row['id'];
            header("Location: index.php"); // Modify to go to the page you would like 
            exit; 
        }else{
            $error = TRUE;
        }
    }else{ 
        $error = TRUE;
    } 
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
        <form action="login.php" method="post" class="form-box">
            <h2>Log in here</h2>
            <?php if($error==TRUE): ?>
                <span>Wrong username or password.</span>
            <?php endif; ?>
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
