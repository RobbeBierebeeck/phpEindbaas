<?php
session_start();
use vendor\Drop\Core\Post;
include_once ('vendor/autoload.php');
$page = 1;
$limitPerPage= 8;
if (!empty($_GET['page'])) {
    $page = $_GET['page'];
    $posts = Post::getAll( $page *$limitPerPage, $limitPerPage);

} else {
    $posts = Post::getAll(0, 8);
}
if (!empty($_GET['search'])) {
    $posts = Post::search($_GET['search'], 0, 8);
}
if(!empty($_GET['search'])&&!empty($_GET['page'])){
    $page = $_GET['page'];
    $posts = Post::search($_GET['search'], $_GET['page'] * $limitPerPage, $limitPerPage);
}
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


<div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 m-auto mt-5 container-lg">
        <?php if (isset($_SESSION['user'])): ?>
            <?php foreach ($posts as $post): ?>
                <div class="col mt-4">
                    <div href="index.php" class="card col mt-4 ">
                        <img src="<?php echo $post['image'] ?>" class="card-img-top" alt="...">
                        <div class="card-body d-flex flex-column">
                            <a href="#"
                               class="card-title h5 text-decoration-none link-dark mb-2 "><?php echo $post['title'] ?></a>
                            <a href="#" class="btn btn-primary"><i class="bi bi-heart pe-2"></i>Like</a>
                            <div class=" d-flex flex-row align-items-center mt-2">
                                <div><i class="bi bi-heart-fill"></i><span class="ms-2">100</span></div>
                                <div><i class="bi bi-eye-fill ms-3"></i><span class="ms-2">100</span></div>
                            </div>
                        </div>
                        <div class="list-group list-group-flush d-flex flex-row align-items-center">
                            <span class="rounded-circle nav__profilePicture ms-3 m-2"
                                  style="background-image: url('<?php echo $post['profile_image'] ?>');"></span>
                            <span>by <a href="profile.php?id=<?php echo $post['id']; ?>" class="fw-bolder"><?php echo $post['firstname'] . " " . $post['lastname'] ?></a> </span> </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <?php foreach ($posts as $post): ?>
                <div href="index.php" class="col mt-4">
                    <div class="card">
                        <img src="<?php echo $post['image'] ?>" class="card-img-top" alt="...">
                        <div class="card-body d-flex flex-row justify-content-between">
                            <h5 class="card-title "><?php echo $post['title'] ?></h5>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php if (!$posts):?>
            <div class="d-flex vw-100 vh-100 align-items-center justify-content-center">
                <img src="images/noresult.svg" alt="">
            </div>
        <?php endif; ?>
        <div class="vw-100 d-flex justify-content-center align-items-center pt-4 pb-4">
            <?php if(!isset($_GET['search'])): ?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page -1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="?page=0">1</a></li>
                        <li class="page-item"><a class="page-link" href="?page=1">2</a></li>
                        <li class="page-item"><a class="page-link" href="?page=2">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page +1; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            <?php else:?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="?search=<?php echo $_GET['search']?>&page=<?php echo $page -1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="?search=<?php echo$_GET['search']?>&page=0">1</a></li>
                        <li class="page-item"><a class="page-link" href="?search=<?php echo$_GET['search']?>&page=1">2</a></li>
                        <li class="page-item"><a class="page-link" href="?search=<?php echo$_GET['search']?>&page=2">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="?search=<?php echo $_GET['search']?>&page=<?php echo $page +1; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            <?php endif;?>
        </div>
    </div>

</body>

</html>