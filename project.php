<?php
session_start();
use Drop\Core\Post;
use Drop\Core\User;
use Drop\Helpers\Security;

include_once ('vendor/autoload.php');

?><!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="UTF-8">
    <title>Bootstrap</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-avatar@latest/dist/avatar.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
<?php if (isset($_SESSION['user'])): ?>
    <?php include_once(__DIR__ . '/partials/header.inc.php'); ?>
<?php else: ?>
<nav class="navbar navbar-light bg-light fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="images/logo.svg" alt="" width="30" height="24" class="d-inline-block align-text-top">
            Drop
        </a>
        <div class="d-flex">
            <a href="register.php" class="btn btn-primary me-3">Register</a>
            <a href="login.php" class="btn btn-outline-primary">Login</a>
        </div>

    </div>

</nav>
<?php endif; ?>
<div class="container mt-5 pt-5">
    <div class="row flex-lg-nowrap">
        <div class=" col-12 col-lg-12 mb-3">
            <div class="d-flex flex-col pt-3 pb-3 ms-5">
                <img class="avatar avatar-48 bg-light rounded-circle text-white dropdown-toggle"
                     id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" data-bs-toggle="dropdown"
                     aria-expanded="false" role="button" src="">
                <div class="ms-3">
                    <p class="mb-0"><strong>x</strong></p>
                    <a href=""><small>x</small></a>
                </div>
            </div>
        </div>
    </div>
    <img src="" class="img-fluid rounded-3" alt="Responsive image">
    <p class="mt-5 ms-5 me-5">x</p>
</div>
</body>
</html>
