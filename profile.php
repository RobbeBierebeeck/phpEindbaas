<?php

use Drop\Core\Post;
use Drop\Core\Followers;
use Drop\Core\User;
use Drop\Helpers\Security;
use Drop\Core\XSS;
use Drop\Core\Warning;
include_once ('vendor/autoload.php');
Security::onlyLoggedInUsers();

if (!empty($_GET["id"])) {
    $target_user = $_GET["id"];
    $followStatus = Followers::getFollowerStatus($target_user, User::getUserId($_SESSION["user"]));
} else {
    $target_user = User::getUserId($_SESSION["user"]);
}
if (isset($_POST['deletePost'])){

}
if (isset($_POST['editPost'])){

}
if (isset($_POST['warning'])){
    try {
        $warning = new Warning();
        $warning->setWarnedId($target_user);
        $warning->setUserId(User::getUserId($_SESSION["user"]));
        var_dump($warning);
        $warning->saveWarning();
    } catch (\Throwable $e) {
        $error = $e->getMessage();
    }
}

$userData = User::getById($target_user);
$profileImg = $userData["profile_image"];
$posts = Post::getUserProjectsById($target_user);
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
    <?php include_once(__DIR__ . '/partials/header.inc.php')?>
    <div id="container" class=" mt-5">

    </div>
    <div  class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 m-auto mt-5 container-lg">
        <img src="<?php echo $profileImg ?>">
        <div>
            <p><?php echo XSS::specialChars($userData['firstname']); ?> <?php echo XSS::specialChars($userData['lastname']); ?>
            <?php if($userData['role'] == 'Moderator') : ?>
                <span class="badge bg-dark">Mod</span>
            <?php endif ?>
        </p>

        <?php if(empty($_GET["id"])) : ?>
            <p><?php echo Followers::getAllFollowers(User::getUserId($_SESSION["user"]))?> followers</p>
        <?php endif ?>

        </div>
        <p><?php echo XSS::specialChars($userData['bio']); ?></p>
        <div>
            <?php if($target_user !== User::getUserId($_SESSION["user"])) : ?> 
                <form method="POST">
                    <button name="follow" class="btn btn-primary align-self-center follow followBtn" data-target-user-id="<?php echo $target_user?>"><?php echo $followStatus?></button>
                </form>
            <?php endif ?> 
            <?php if((User::getById(User::getUserId($_SESSION["user"]))["role"] == "Moderator") && (!empty($_GET["id"])) && ($userData['role'] !== "Moderator")): ?>
                <form method="POST">
                    <button name="mod" class="btn btn-outline-primary align-self-center moderatorBtn" data-target-user-id="<?php echo $target_user?>">
                    <?php if(User::getModStatus($target_user)['role'] == "Moderator"){
                        echo "remove from moderation";
                    }else{echo "set moderator";}
                     ?></button>
                </form>
            <?php endif ?>
            <?php if( (User::getById(User::getUserId($_SESSION["user"]))["role"] !== "User")  && (!empty($_GET["id"]))): ?>
                <form method="POST">
                    <button name="warning" class="btn btn-outline-danger align-self-center">warn</button>
                </form>
            <?php endif ?>
            <?php if (!User::checkIfReported(User::getUserId($_SESSION['user']), $_GET['id'])):?>
                <form method="POST">
                    <button id="reportButton" type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Report
                    </button>
                </form>
            <?php endif;?>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 m-auto mt-5 container-lg">
        <?php if (isset($_SESSION['user'])) : ?>
            <?php foreach ($posts as $post) : ?>
                <div class="col mt-4">
                    <div href="project.php?post=<?php echo $post['id']?>" class="card col mt-4 d-flex ">
                            <div class="d-flex position-absolute align-self-end">
                                <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><button type="submit" class="dropdown-item" name="editPost" href="#">Edit Post</button></li>
                                    <li><button type="submit" class="dropdown-item" name="deletePost" href="#">Delete Post</button></li>
                                </ul>
                            </div>
                        <img src="<?php echo $post['image'] ?>" class="card-img-top" alt="...">
                        <div class="card-body d-flex flex-column">
                            <a href="project.php?post=<?php echo $post['id']?>" class="card-title h5 text-decoration-none link-dark mb-2 "><?php echo XSS::specialChars($post['title']); ?></a>
                            <a href="#" class="btn btn-primary"><i class="bi bi-heart pe-2"></i>Like</a>
                            <div class=" d-flex flex-row align-items-center mt-2">
                                <div><i class="bi bi-heart-fill"></i><span class="ms-2">100</span></div>
                                <div><i class="bi bi-eye-fill ms-3"></i><span class="ms-2">100</span></div>
                            </div>
                        </div>
                        <div class="list-group list-group-flush d-flex flex-row align-items-center">
                            <span class="rounded-circle nav__profilePicture ms-3 m-2" style="background-image: url('<?php echo $post['profile_image'] ?>');"></span>
                            <span>by <a href="profile.php?id=<?php echo $post['id']; ?>" class="fw-bolder"><?php echo XSS::specialChars($post['firstname']) . " " . XSS::specialChars($post['lastname']) ?></a> </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <?php foreach ($posts as $post) : ?>
                <div href="project.php?post=<?php echo $post['id']?>" class="col mt-4">
                    <div class="card">
                        <img src="<?php echo $post['image'] ?>" class="card-img-top" alt="...">
                        <div class="card-body d-flex flex-row justify-content-between">
                            <h5 class="card-title "><?php echo XSS::specialChars($post['title']) ?></h5>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <!--- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Report this user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to report this user?
                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button data-bs-dismiss="modal" type="button" id="report" data-userId = "<?php echo $_GET['id']?>" class="btn btn-primary">Report user</button>
                </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="./scripts/followUser.js"></script>
    <script src="./scripts/saveModerator.js"></script>
    <script src="./scripts/reportUser.js"></script>
</body>

</html>