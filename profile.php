<?php

include_once(__DIR__ . '/helpers/Security.php');
include_once(__DIR__ . '/bootstrap.php');
Security::onlyLoggedInUsers();

$profileImg = User::getProfilePicture($_SESSION['user']);
$userData = User::getById(User::getUserId($_SESSION['user']));

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bootstrap</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-avatar@latest/dist/avatar.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>
<?php include_once(__DIR__ . '/partials/header.inc.php') ?>
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 m-auto mt-5 container-lg">
    <img src="<?php echo $profileImg ?>">
    <p><?php echo $userData['firstname'];?> <?php echo $userData['lastname'];?></p>
    <p><?php echo $userData['bio'];?></p>
</div>
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 m-auto mt-5 container-lg">
    <div class="col mt-4">
        <div class="card">
            <img src="images/post_template.webp" class="card-img-top" alt="...">
            <div class="card-body d-flex flex-row justify-content-between">
                <h5 class="card-title">Card title</h5>
                <div class="d-flex">
                    <p class="me-2"> 400 <i class="bi bi-eye"></i></p>
                    <a> 100 <i class="bi bi-star"></i></a>
                </div>

            </div>
        </div>
    </div>
    <div class="col mt-4">
        <div class="card">
            <img src="images/post_template.webp" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>

            </div>
        </div>
    </div>
    <div class="col mt-4">
        <div class="card">
            <img src="images/post_template.webp" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>

            </div>
        </div>
    </div>
    <div class="col mt-4">
        <div class="card">
            <img src="images/post_template.webp" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>

            </div>
        </div>
    </div>
    <div class="col mt-4">
        <div class="card">
            <img src="images/post_template.webp" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
            </div>
        </div>
    </div>
    <div class="col mt-4">
        <div class="card">
            <img src="images/post_template.webp" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
            </div>
        </div>
    </div>
</div>
<script src="js/bootstrap.bundle.js"></script>
</body>

</html>