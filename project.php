<?php
use Drop\Core\Post;
use Drop\Core\User;
use Drop\Helpers\Security;
include_once ('vendor/autoload.php');
Security::onlyLoggedInUsers();
$profileImg = User::getProfilePicture($_SESSION['user']);
$id = User::getUserId($_SESSION['user']);

$post = Post::getPostById($_GET['post']);


if (isset($_GET["post"])) {
    $target_user = $_GET['post'];
} else {
    $target_user = User::getUserId($_SESSION["user"]);
}
$userData = User::getById($id);
if (!empty($_GET)) {
    $post = Post::getPostById($_GET['post']);
    $creator = Post::getCreatorByPost($_GET['post']);
} else (
header("Location: 404.html")
);
if (isset($_POST['deletePost'])){
    Post::deletePostImage($post['id']);
    Post::deleteProjectTags($post['id']);
    Post::deletePostById($post['id']);
    header("Location: index.php");
}
if (isset($_POST['editPost'])){
    Post::updatePost($_POST['title'],$_POST['tags'] ,$post['id']);

    header("refresh:0");
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
<div class="container mt-5 pt-5">
    <div class="row flex-lg-nowrap d-flex justify-content-center">
        <div class=" col-12 col-lg-8 mb-3">
            <div class="d-flex flex-col pt-3 pb-3 ms-5">
                <img class="avatar avatar-48 bg-light rounded-circle text-white dropdown-toggle"
                     id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" data-bs-toggle="dropdown"
                     aria-expanded="false" role="button" src="<?php echo $creator['profile_image'] ?>">
                <div class="ms-3">
                    <p class="mb-0"><strong><?php echo $post['title']?></strong></p>
                    <a href="profile.php?user=<?php echo $creator['id']?>"><small><?php echo $creator['firstname'];?> <?php echo $creator['lastname'];?></small></a>
                </div>
            </div>
            <div>
                <?php if ($creator['id'] == $id) : ?>
                <div class="d-flex position-absolute align-self-end">
                    <button class="btn bg-light mt-2 ms-2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><button type="submit" data-bs-toggle="modal" class="dropdown-item" name="editPost" href="#editPostModalToggle">Edit Post</button></li>
                        <li><button type="submit" data-bs-toggle="modal" class="dropdown-item" name="deletePost"  href="#deletePostModalToggle">Delete Post</button></li>
                        <li><button  class="dropdown-item" >Add to portfolio</button></li>
                    </ul>
                </div>
                <?php endif; ?>
                <img src="<?php echo $post['image']?>" class="img-fluid rounded-3" alt="Responsive image">

            </div>
            <p class="mt-5 ms-5 me-5"><?php echo $post['description']?></p>

            <div class="modal fade" id="deletePostModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel">Delete post</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            You are about to delete your post. Are you sure?
                        </div>
                        <div class="modal-footer">
                            <form id="deletePost" class="mb-0" action="" method="post">
                                <button type="submit" class="btn btn-danger w-100" name="deletePost">Delete my post</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editPostModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel">Edit post</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editPost" class="mb-0" action="" method="post">
                                <div class="form-group mb-3">
                                    <!-- Tag input feeld -->
                                    <div class="mt-3 mb-3">
                                        <label class="form-label" for="floatingInput">Tags</label>
                                        <div class="input form-control" id="floatingInput">
                                            <div class="input__tags"></div>
                                            <input type="text" class="p-2" id="tags">
                                        </div>
                                    </div>
                                    <input type="text" name="tags" id="tags-fake">
                                    <!-- Title input feeld -->
                                    <div class="mb-5">
                                        <label class="mb-1">Post title</label>
                                        <div class="form">
                                            <input type="text" name="title" class="form-control p-3" id="usernameInput" placeholder="Username" value="<?php echo $post['title'];?>" required>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100" name="editPost">Save changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="scripts/tags.js"></script>
</body>
</html>
