<?php 
    include('authorize.php');
    include('connection.php');
    $userId = $_SESSION['userId'];
    $username = $_SESSION['username'];
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $sql = mysqli_query($conn, "SELECT * FROM images WHERE userId='$userId'");
?> 
<!DOCTYPE html>
<html>
<head>
    <title>Photo Collection</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
<header class="header">
    <div class="header__left">
        <h1 class="header__title title">Photo collection</h1>
        <h2 class="header__greeting">Welcome - <?php echo $firstname." ".$lastname; ?></h2>
        <p class="header__description">This is your photo collection.</p>
    </div>
    <div class="header__right">
        <a href="logout.php" class="header__link">Log out</a>
    </div>
</header>
<button class="upload-button" id="upload-button">
    <img src="add_photo.svg" alt="">
    <span class="upload-button__text">Add photo</span>
</button>
<form hidden id="form" action="upload.php" method="post" enctype="multipart/form-data" name="upload">
    <input type="file" name="fileToUpload" id="fileToUpload" accept="image/jpg,image/jpeg,image/png,image/gif">
    <input type="submit" value="Upload Image" name="submitBtn">
</form>
<?php if (mysqli_num_rows($sql) > 0): ?> 
    <div class="collection">
        <?php while($row = mysqli_fetch_assoc($sql)): ?>
            <div class="photo-container">
                <img class="photo" 
                    image-id="<?= $row['id'] ?>" 
                    src="<?= $row['path'] ?>" 
                    width="<?= $row['width'] ?>" 
                    height="<?= $row['height'] ?>" />
            </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <div class="no-photos">
        <p>You have not yet added any photos.</p>
    </div>
<?php endif; ?>
<div class="dialog">
    <div class="dialog__overlay"></div>
    <!-- <img class="dialog__image" src="" alt=""> -->
    <button class="button delete-button" id="delete-button">
        <img src="delete.svg" alt="">
        <span class="delete-button__text">Delete photo</span>
    </button>
</div>
<script src="script.js"></script>
</body>
</html>