<?php

include_once(__DIR__ . '/helpers/Security.php');
include_once(__DIR__ . '/bootstrap.php');
Security::onlyLoggedInUsers();

if (isset($_GET["id"])) {
    $target_user = $_GET['id'];
} else {
    $target_user = User::getUserId($_SESSION["user"]);
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
    <?php include_once(__DIR__ . '/partials/header.inc.php')
    ?>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 m-auto mt-5 container-lg">
        <img src="<?php echo $profileImg ?>">
        <p><?php echo $userData['firstname']; ?> <?php echo $userData['lastname']; ?></p>
        <p><?php echo $userData['bio']; ?></p>
    </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 m-auto mt-5 container-lg">
        <?php if (isset($_SESSION['user'])) : ?>
            <?php foreach ($posts as $post) : ?>
                <div class="col mt-4">
                    <div href="index.php" class="card col mt-4 ">
                        <img src="<?php echo $post['image'] ?>" class="card-img-top" alt="...">
                        <div class="card-body d-flex flex-column">
                            <a href="#" class="card-title h5 text-decoration-none link-dark mb-2 "><?php echo $post['title'] ?></a>
                            <a href="#" class="btn btn-primary"><i class="bi bi-heart pe-2"></i>Like</a>
                            <div class=" d-flex flex-row align-items-center mt-2">
                                <div><i class="bi bi-heart-fill"></i><span class="ms-2">100</span></div>
                                <div><i class="bi bi-eye-fill ms-3"></i><span class="ms-2">100</span></div>
                            </div>
                        </div>
                        <div class="list-group list-group-flush d-flex flex-row align-items-center">
                            <span class="rounded-circle nav__profilePicture ms-3 m-2" style="background-image: url('<?php echo $post['profile_image'] ?>');"></span>
                            <span>by <a href="profile.php?id=<?php echo $post['id']; ?>" class="fw-bolder"><?php echo $post['firstname'] . " " . $post['lastname'] ?></a> </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <?php foreach ($posts as $post) : ?>
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
    </div>
    <script src="js/bootstrap.bundle.js"></script>
</body>

</html>