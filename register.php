<?php 
session_start(); 
if($_SESSION && $_SESSION['logged']){ 
    header("Location: index.php"); 
    exit; 
} 
$usernameExist = FALSE; 
if(isset($_POST['submit'])){ 
    include_once('connection.php');
    
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $usr = mysqli_real_escape_string($conn, $_POST['username']); 
    $hash = password_hash($password, PASSWORD_BCRYPT);
    $sql = mysqli_query($conn, "INSERT INTO users (username, email, password, firstname, lastname) 
        VALUES('$usr', '$email', '$hash', '$firstname', '$lastname')");
    if($sql == 1){ 
        $user = mysqli_query($conn, "SELECT * FROM users 
            WHERE username='$usr'
            LIMIT 1"); 
        $row = mysqli_fetch_array($user);
        session_start(); 
        $_SESSION['username'] = $usr;
        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['userId'] = $row['id'];
        $_SESSION['logged'] = TRUE; 
        header("Location: index.php");
        exit;
    }else{ 
        $usernameExist = TRUE; 
    } 
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="blue-bg">
    <div class="box-wrapper">
        <h1 class="title">Photo Collection</h1>
        <form action="register.php" method="post" class="form-box">
            <h2>Register here</h2> 
            <input class="input" required type="text" name="username" placeholder="Username"><br><br> 
            <input class="input" required type="text" name="firstname" placeholder="First name"><br><br> 
            <input class="input" required type="text" name="lastname" placeholder="Last name"><br><br> 
            <input class="input" required type="email" name="email" placeholder="Email"><br><br> 
            <input class="input" required type="password" name="password" placeholder="Password"><br><br> 
            <input type="submit" name="submitBtn" value="Register" class="button"> 
            <?php if($usernameExist) : ?>
                The username already exists.
            <?php endif; ?>
        </form> 
    </div>

</body>
</html>

