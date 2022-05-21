<?php
session_start();
use Drop\Core\Post;
use Drop\Core\Like;
use Drop\Core\User;
use Drop\Core\Warning;
use Drop\Core\XSS;
include_once('vendor/autoload.php');
$page = 1;
$limitPerPage = 8;

if(isset($_SESSION["user"])){
    $warnings = Warning::getUserWarnings(User::getUserId($_SESSION["user"]));
}

if (!empty($_GET['page'])) {
    $page = $_GET['page'];
    $posts = Post::getAll($page * $limitPerPage, $limitPerPage);    
} else {
    $posts = Post::getAll(0, 8);
}

if (!empty($_GET['search'])) {
    $posts = Post::search($_GET['search'], 0, 8);
}

if (!empty($_GET['search']) && !empty($_GET['page'])) {
    $page = $_GET['page'];
    $posts = Post::search($_GET['search'], $_GET['page'] * $limitPerPage, $limitPerPage);
}


if(!empty ($_GET['filter'])){

    switch ($_GET['filter']){

        case 'newest':
                $posts = Post::getAll(0, 8);
            break;
        case 'oldest':

        $posts = Post::getAllOldest(0, 8);
            break;
        case 'following':
            $posts = Post::getAllFollowing(0, 8, User::getUserId($_SESSION['user']));
            break;
    }

}

if(!empty($_GET['filter']) && !empty($_GET['page'])){

    switch ($_GET['filter']){

        case 'newest':
                $posts = Post::getAll($_GET['page'] * $limitPerPage, $limitPerPage);
            break;
        case 'oldest':

        $posts = Post::getAllOldest($_GET['page'] * $limitPerPage, $limitPerPage);
            break;
        case 'following':
            $posts = Post::getAllFollowing($_GET['page'] * $limitPerPage, $limitPerPage, User::getUserId($_SESSION['user']));
            break;
    }

}
?><!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
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

<?php if (isset($warnings) && $warnings['status'] == 'pending'): ?>
    <div class="warningAlert">
    <div class="alert alert-danger mt-5 pt-4 d-flex flex-row align-center justify-content-between" role="alert">
        <p class="mb-0">This is your warning <strong>#<?php echo $warnings ?></strong> because you didn't meet our terms of use.
        By closing this warning you accept this warning and implications of a warning #3 (account ban)</p>
        <a type="button" href="#" class="close alert-link text-decoration-none warningLink" data-user-id="<?php echo User::getUserId($_SESSION["user"])?>" data-dismiss="alert">close</a>
    </div>
    </div>
<?php endif; ?>

<?php if (!isset($_GET['search'])):?>
<div class="mt-5">
    <div class="btn-group mt-5 ms-5">
        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Filter
        </button>
        <ul class="dropdown-menu">
            <li><h6 class="dropdown-header">Sort by date</h6></li>
            <li><a class="dropdown-item" href="index.php?filter=newest">Newest</a></li>
            <li><a class="dropdown-item" href="index.php?filter=oldest">Oldest</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><h6 class="dropdown-header">Filter</h6></li>
            <li><a class="dropdown-item" href="index.php?filter=following">Following</a></li>
        </ul>
    </div>
<?php endif;?>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 m-auto  container-lg">
        <?php if (isset($_SESSION['user'])): ?>
            <?php foreach ($posts as $post): ?>
                <div class="col mt-4">
                    <div href="project.php?post=<?php echo $post['id'] ?>" class="card col mt-4 ">
                        <img src="<?php echo $post['image'] ?>" class="card-img-top" alt="...">
                        <div class="card-body d-flex flex-column">
                            <a href="project.php?post=<?php echo $post['id'] ?>"
                               class="card-title h5 text-decoration-none link-dark mb-2 "><?php echo XSS::specialChars($post['title']) ?></a>

                            <?php if (Like::isLiked($post['id'], User::getUserId($_SESSION['user']))): ?>
                                <a href="#" data-status="liked" data-post="<?php echo $post['id'] ?>"
                                   class="btn btn-primary like"><i class="bi bi-heart-fill"></i> Liked</a>
                            <?php else: ?>
                                <a href="#" data-status="like" data-post="<?php echo $post['id'] ?>"
                                   class="btn btn-primary like"><i class="bi bi-heart pe-2"></i>Like</a>

                            <?php endif; ?>

                            <div class=" d-flex flex-row align-items-center mt-2">
                                <div><i class="bi bi-heart-fill"></i><span id="likes"
                                                                           class="ms-2"><?php echo $post['likes'] ?></span>
                                </div>
                                <div><i class="bi bi-eye-fill ms-3"></i><span id="views"
                                                                              class="ms-2"><?php echo $post['views'] ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="list-group list-group-flush d-flex flex-row align-items-center">
                            <span class="rounded-circle nav__profilePicture ms-3 m-2" style="background-image: url('<?php echo $post['profile_image'] ?>');"></span>
                            <span>by <a href="profile.php?id=<?php echo Post::getCreatorByPost($post['id'])["id"]?>" class="fw-bolder"><?php echo XSS::specialChars($post['firstname']) . " " . XSS::specialChars($post['lastname']) ?></a> </span> </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <?php foreach ($posts as $post): ?>
                <div href="project.php?post=<?php echo $post['id'] ?>" class="col mt-4">
                    <div class="card">
                        <img src="<?php echo $post['image'] ?>" class="card-img-top" alt="...">
                        <div class="card-body d-flex flex-row justify-content-between">
                            <h5 class="card-title "><?php echo XSS::specialChars($post['title']) ?></h5>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- empty state -->
        <?php if (!$posts): ?>
            <div class="d-flex vw-100 vh-100 align-items-center justify-content-center">
                <img src="images/noresult.svg" alt="">
            </div>
        <?php endif; ?>


        <!-- pagination -->
        <div class="vw-100 d-flex justify-content-center align-items-center pt-4 pb-4">
            <?php if (isset($_GET['search'])): ?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link"
                               href="?search=<?php echo $_GET['search'] ?>&page=<?php echo $page - 1; ?>"
                               aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link"
                                                 href="?search=<?php echo $_GET['search'] ?>&page=0">1</a></li>
                        <li class="page-item"><a class="page-link"
                                                 href="?search=<?php echo $_GET['search'] ?>&page=1">2</a></li>
                        <li class="page-item"><a class="page-link"
                                                 href="?search=<?php echo $_GET['search'] ?>&page=2">3</a></li>
                        <li class="page-item">
                            <a class="page-link"
                               href="?search=<?php echo $_GET['search'] ?>&page=<?php echo $page + 1; ?>"
                               aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>


            <?php elseif(isset($_GET['filter'])):?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link"
                               href="?filter=<?php echo $_GET['filter'] ?>&page=<?php echo $page - 1; ?>"
                               aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link"
                                                 href="?filter=<?php echo $_GET['filter'] ?>&page=0">1</a></li>
                        <li class="page-item"><a class="page-link"
                                                 href="?filter=<?php echo $_GET['filter'] ?>&page=1">2</a></li>
                        <li class="page-item"><a class="page-link"
                                                 href="?filter=<?php echo $_GET['filter'] ?>&page=2">3</a></li>
                        <li class="page-item">
                            <a class="page-link"
                               href="?filter=<?php echo $_GET['filter'] ?>&page=<?php echo $page + 1; ?>"
                               aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>

            <?php else: ?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="?page=0">1</a></li>
                        <li class="page-item"><a class="page-link" href="?page=1">2</a></li>
                        <li class="page-item"><a class="page-link" href="?page=2">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </div>
    <script src="./scripts/like.js"></script>
    <script src="./scripts/warningAlert.js"></script>
</body>

</html>