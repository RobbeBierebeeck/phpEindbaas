<?php
use Drop\Core\Post;
use Drop\Core\User;
use Drop\Helpers\Security;
use Drop\Core\XSS;
use Drop\Core\Comment;
use Drop\Core\View;
include_once('vendor/autoload.php');
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

//rerouting if get is empty
if (!empty($_GET)) {
    $post = Post::getPostById($_GET['post']);
    $creator = Post::getCreatorByPost($_GET['post']);
    $tags = Post::getTagsById($_GET['post']);

} else (
header("Location: 404.html")
);

//delete post

if (!empty($_POST['deletePost'])) {
    Post::deletePostImage($_POST['deletePost']);
    Post::deleteProjectTags($_POST['deletePost']);
    Post::deletePostById($_POST['deletePost']);
    header("Location: index.php");
}

//editing post

if (isset($_POST['editPost'])) {
    Post::updatePost($_POST['title'], $_POST['tags'], $post['id']);

    header("refresh:0");
}

// comments
if (isset($_POST['commentPost'])) {
    try {
        $comment = new Comment();
        $comment->setComment($_POST['comment']);
        $comment->setUserId($id);
        $comment->setProjectId($post['id']);
        $comment->save();
    } catch (\Throwable $th) {
        echo $th->getMessage();
    }
}
$comments = Comment::getAll($post['id']);

//views
    if(!View::alreadyViewed($_SERVER['REMOTE_ADDR'], $_GET['post'], User::getUserId($_SESSION['user']))){
        $view = new View();
        $view->setUserId( User::getUserId($_SESSION['user']));
        $view->setPostId($_GET['post']);
        $view->setIp($_SERVER['REMOTE_ADDR']);
        $view->save();
    }
?><!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>
    <meta charset="UTF-8">
    <title>Post</title>
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
                    <p class="mb-0"><strong><?php echo XSS::specialChars($post['title']) ?></strong></p>
                    <a href="profile.php?id=<?php echo $creator['id'] ?>"><small><?php echo XSS::specialChars($creator['firstname']); ?><?php echo XSS::specialChars($creator['lastname']); ?></small></a>
                </div>
                <div class="btn-group ms-auto p-2">
                    <button class="btn btn-secondary btn-sm dropdown-toggle optionsToggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        options
                    </button>
                    <ul class="dropdown-menu">
                        <li><a data-project-id="<?php echo $post['id']?>" data-user-id="<?php echo User::getUserId($_SESSION['user'])?>" class="dropdown-item reportProject" href="#">report project</a></li>
                    </ul>
                </div>
            </div>
            <div>
                <?php if ($creator['id'] == $id) : ?>
                    <div class="d-flex position-absolute align-self-end">
                        <button class="btn bg-light mt-2 ms-2" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li>
                                <button type="submit" data-bs-toggle="modal" class="dropdown-item" name="editPost"
                                        href="#editPostModalToggle">Edit Post
                                </button>
                            </li>
                            <li>
                                <button type="submit" data-bs-toggle="modal" class="dropdown-item" name="deletePost"
                                        href="#deletePostModalToggle">Delete Post
                                </button>
                            </li>
                            <?php if (Post::isShowcase($post['id']) == 0): ?>
                                <li>
                                    <button id="showcase" data-post="<?php echo $post['id'] ?>" class="dropdown-item">
                                        Add to showcase
                                    </button>
                                </li>
                            <?php else: ?>
                                <li>
                                    <button id="showcase" data-post="<?php echo $post['id'] ?>" class="dropdown-item">
                                        Remove from showcase
                                    </button>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                <?php elseif (User::isModerator(User::getUserId($_SESSION['user']))): ?>

                    <div class="d-flex position-absolute align-self-end">
                        <button class="btn bg-light mt-2 ms-2" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li>
                                <button type="submit" data-bs-toggle="modal" class="dropdown-item" name="deletePost"
                                        href="#deletePostModalToggle">Delete Post
                                </button>
                            </li>
                        </ul>
                    </div>
                <?php endif; ?>


                <img src="<?php echo $post['image'] ?>" class="img-fluid rounded-3" alt="Responsive image">

            </div>

            <div class="mt-3">
                <h3>Tags used</h3>
                <?php if(!empty($tags)):?>
                <div class="d-flex flex-row">
                    <?php foreach ($tags as $tag): ?>
                        <p class="badge bg-primary me-3 "><?php echo $tag['tag'] ?></p>
                    <?php endforeach; ?>
                </div>
                <?php elseif (empty($tags) || $tags ===""): ?>
                    <p>No tags used</p>
                <?php endif; ?>
            </div>
            <p class="mt-5 ms-5 me-5"><?php echo XSS::specialChars($post['description']) ?></p>


            <?php if ($creator['id'] == $id): ?>
                <div class="modal fade" id="deletePostModalToggle" aria-hidden="true"
                     aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalToggleLabel">Delete post</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                You are about to delete your post. Are you sure?
                            </div>
                            <div class="modal-footer">
                                <form id="deletePost" class="mb-0" action="" method="post">
                                    <input name="deletePost" value="<?php echo $_GET['post'] ?>" type="text" hidden>
                                    <button type="submit" class="btn btn-danger w-100">Delete my post
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="editPostModalToggle" aria-hidden="true"
                     aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalToggleLabel">Edit post</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
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
                                                <input type="text" name="title" class="form-control p-3"
                                                       id="usernameInput"
                                                       placeholder="Username" value="<?php echo $post['title']; ?>"
                                                       required>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100" name="editPost">Save changes
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php elseif (User::isModerator(User::getUserId($_SESSION['user']))): ?>
                <div class="modal fade" id="deletePostModalToggle" aria-hidden="true"
                     aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalToggleLabel">Delete post</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                You are about to delete your post. Are you sure?
                            </div>
                            <div class="modal-footer">
                                <form id="deletePost" class="mb-0" action="" method="post">
                                    <input name="deletePost" value="<?php echo $_GET['post'] ?>" type="text" hidden>
                                    <button type="submit" class="btn btn-danger w-100">Delete my post
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>


        <div class="row d-flex justify-content-center col-lg-4 col-lg-4 col-lg-4 col-lg-4  ">
            <div class="position-sticky">
                <div class="card shadow-0 border" style="background-color: #f0f2f5;">
                    <div class="card-body p-4 comments">
                        <form action="" method="post" class="form-outline mb-4 ">
                            <h1>Feedback</h1>
                            <div class="d-flex flex-row">
                                <input type="text" id="comment" name="comment" class="form-control"
                                       placeholder="Enter a comment" required>
                                <input id="submitComment" type="submit" data-post="<?php echo $_GET['post'] ?>"
                                       value="Post" name="commentPost" class="btn btn-outline-primary ms-2">
                            </div>
                        </form>
                        <ul id="comments" class="overflow-auto card px-2 d-flex flex-column-reverse mh-10">
                            <?php foreach ($comments as $c): ?>
                                <div class='card-body border-bottom'>
                                    <div class='d-flex justify-content-between'>
                                        <div class='d-flex flex-row align-items-center'>
                                            <img src='<?php echo $c['profile_image'] ?>' alt='avatar' width='25'
                                                 height='25'/>
                                            <p class='small mb-0 ms-2'><?php echo $c['firstname'] ?><?php echo $c['lastname'] ?></p>
                                        </div>
                                    </div>
                                    <p class='test'><?php echo $c['comment'] ?></p>
                                </div>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="scripts/tags.js"></script>
<script src="scripts/showcase.js"></script>
<script src='scripts/comment.js'></script>
<script src='scripts/reportProject.js'></script>
</body>
</html>
