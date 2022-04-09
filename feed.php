<?php

include_once(__DIR__ . '/helpers/Security.php');
include_once(__DIR__ . '/bootstrap.php');
Security::onlyLoggedInUsers();

$profileImg = User::getProfilePicture($_SESSION['user']);

// User::getProfilePicture();

?><!DOCTYPE html>
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

<nav class="navbar navbar-light bg-light fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="images/logo.svg" alt="" width="30" height="24" class="d-inline-block align-text-top">
            Drop
        </a>
        <form>
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
        </form>
        <div class="d-flex align-items-center">
            <div class="dropdown">
                <img class="avatar avatar-48 bg-light rounded-circle text-white p-2 dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" data-bs-toggle="dropdown" aria-expanded="false" role="button" src="<?php echo User::getProfilePicture()?>">
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Profiel</a></li>
                    <li><a class="dropdown-item" href="accountSettings.php">Instellingen</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="logout.php">Afmelden</a></li>
                </ul>
            </div>
            <i class="bi bi-bell fs-5 me-2"></i>
            <button type="button" class="btn btn-primary">Drop your shot</button>
            </img>

        </div>
</nav>
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mt-5 container-lg">
    <div class="col mt-4">
        <div class="card">
            <img src="images/post_template.webp" class="card-img-top" alt="...">
            <div class="card-body d-flex flex-row justify-content-between">
                <h5 class="card-title">Card title</h5>
                <div class="d-flex">
                    <p class="me-2"> 400 <i class="bi bi-eye"></i> </p>
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