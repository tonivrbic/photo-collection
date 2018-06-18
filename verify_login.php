<?php 
if(isset($_POST['submit'])){ 
    include('connection.php');
    
    //Lets search the databse for the user name and password 
    //Choose some sort of password encryption, I choose sha256 
    //Password function (Not In all versions of MySQL). 
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
        }
    }else{ 
        header("Location: login.php"); 
        exit; 
    } 
}else{    //If the form button wasn't submitted go to the index page, or login page 
    header("Location: index.php");     
    exit; 
} 
?> 