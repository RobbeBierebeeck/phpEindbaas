<?php
session_start();
//include_once(__DIR__ . '/helpers/Security.php');
include_once(__DIR__ . '/bootstrap.php');
$posts = Post::getAll();
?><!DOCTYPE html>
<html lang="en">

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
    <nav class="navbar navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="images/logo.svg" alt="" width="30" height="24" class="d-inline-block align-text-top">
                Drop
            </a>
            <form>
                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
            </form>
            <div class="d-flex align-items-center">
                <span class="rounded-circle nav__profilePicture"
                      style="background-image: url('<?php echo User::getProfilePicture($_SESSION['user']) ?>');"></span>
                <div class="dropdown">

                    <span class=" dropdown-toggle" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true"
                          data-bs-toggle="dropdown" aria-expanded="false" role="button">
                        <?php echo htmlspecialchars(User::getById(User::getUserId($_SESSION['user']))['firstname']) ?>
                    </span>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="account/profile.php">Profiel</a></li>
                        <li><a class="dropdown-item" href="account/accountSettings.php">Instellingen</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="logout.php">Afmelden</a></li>
                    </ul>
                </div>
                <i class="bi bi-bell fs-5 me-2"></i>
                <a href="newPost.php" button" class="btn btn-primary">Drop your shot</a>
            </div>
        </div>
    </nav>
<?php else: ?>
    <nav class="navbar navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="images/logo.svg" alt="" width="30" height="24" class="d-inline-block align-text-top">
                Drop
            </a>


            <div class="d-flex">
                <a href="register.php" class="btn btn-primary me-3">Register</a>
                <a href="login.php"  class="btn btn-outline-primary">Login</a>
            </div>

        </div>

    </nav>
<?php endif; ?>


<div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 m-auto mt-5 container-lg">
        <?php foreach ($posts as $post):?>
        <div class="col mt-4">
            <div class="card">
                <img src="<?php echo $post['image']?>" class="card-img-top" alt="...">
                <div class="card-body d-flex flex-row justify-content-between">
                    <h5 class="card-title"><?php echo $post['title']?></h5>

                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <div class="vw-100 d-flex justify-content-center align-items-center pb-4">

                <a href="newPost.php" class="btn btn-primary">Load more</a>

        </div>
</div>

</body>

</html>