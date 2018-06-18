<?php
include('authorize.php');

// Check if image file is a actual image or fake image
if(isset($_POST["id"])) {
    include('connection.php');
    $imageId = $_POST['id'];
    echo $imageId;
    $userId = $_SESSION['userId'];
    $sql = mysqli_query($conn, "DELETE FROM images WHERE id='$imageId' and userId='$userId'");
    echo $sql;
}
?>