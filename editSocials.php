<?php
include_once(__DIR__ . '/helpers/Security.php');
include_once(__DIR__ . '/bootstrap.php');
Security::onlyLoggedInUsers();
$profileImg = User::getProfilePicture($_SESSION['user']);
$id = User::getUserId($_SESSION['user']);
$userData = User::getById($id);

    if(!empty($_POST)){
    
            $socials = new Socials();
            $socials->setUserId($id);
            $socials->setSocialLink($_POST['socialLink']);
            $socials->setPlatform($_POST['platform']);
            $socials->save();
            $succes = "Link is saved";
    }

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bootstrap</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-avatar@latest/dist/avatar.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</head>

<body>
<<<<<<< HEAD:editSocials.php
<?php include_once(__DIR__ . '/partials/header.inc.php') ?>
<div class="container mt-5 pt-5">
    <div class="row flex-lg-nowrap">
        <div class=" col-12 col-lg-12 mb-3">
            <div class="d-flex flex-col p-3">
                <img class="avatar avatar-48 bg-light rounded-circle text-white dropdown-toggle"
                     id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" data-bs-toggle="dropdown"
                     aria-expanded="false" role="button" src="<?php echo $profileImg ?>">
                <div class="ms-3">
                    <p class="mb-0">
                        <strong><?php echo $userData['firstname']; ?><?php echo $userData['lastname']; ?></strong> <i
                                class="text-muted">/</i><strong> Socials</strong></p>
                    <p><small>Update your username and manage your account</small></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-1 pt-1">
    <div class="row flex-lg-nowrap">
        <div class=" col-12 col-lg-2 mb-3">
            <div class="card p-3">
                <div class="e-navlist e-navlist--active-bg">
                    <ul class="nav d-flex flex-column">
                        <li class="nav-item"><a class="nav-link px-2 text-muted" href="settings.php"><span>General</span></a></li>
                        <li class="nav-item"><a class="nav-link px-2 text-muted" href="editProfile.php" target=""><span>Edit profile</span></a></li>
                        <li class="nav-item"><a class="nav-link px-2 text-muted" href="editPassword.php" target=""><span>Change password</span></a></li>
                        <li class="nav-item"><a class="nav-link px-2 active" href="editSocials.php" target=""><span><strong>Socials</strong></span></a></li>
=======
    <nav class="navbar navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">
                <img src="./../images/logo.svg" alt="" width="30" height="24" class="d-inline-block align-text-top">
                Drop
            </a>
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <img class="avatar avatar-48 bg-light rounded-circle text-white p-2 dropdown-toggle"
                        id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" data-bs-toggle="dropdown"
                        aria-expanded="false" role="button" src="./.<?php echo $profileImg?>">
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="profile.php">Profiel</a></li>
                        <li><a class="dropdown-item" href="settings.php"><strong>Instellingen</strong></a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="../logout.php">Afmelden</a></li>
>>>>>>> feat7:account/editSocials.php
                    </ul>
                </div>
                <i class="bi bi-bell fs-5 me-2"></i>
                <button type="button" class="btn btn-primary">Drop your shot</button>
            </div>
        </div>
    </nav>
    <div class="container mt-5 pt-5">
        <div class="row flex-lg-nowrap">
            <div class=" col-12 col-lg-12 mb-3">
                <div class="d-flex flex-col p-3">
                    <img class="avatar avatar-48 bg-light rounded-circle text-white dropdown-toggle"
                        id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" data-bs-toggle="dropdown"
                        aria-expanded="false" role="button" src="./.<?php echo $profileImg ?>">
                    <div class="ms-3">
                        <p class="mb-0">
                            <strong><?php echo $userData['firstname']; ?><?php echo $userData['lastname']; ?></strong>
                            <i class="text-muted">/</i><strong> Socials</strong></p>
                        <p><small>Update your username and manage your account</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-1 pt-1">
        <div class="row flex-lg-nowrap">
            <div class=" col-12 col-lg-2 mb-3">
                <div class="card p-3">
                    <div class="e-navlist e-navlist--active-bg">
                        <ul class="nav d-flex flex-column">
                            <li class="nav-item"><a class="nav-link px-2 text-muted"
                                    href="settings.php"><span>General</span></a></li>
                            <li class="nav-item"><a class="nav-link px-2 text-muted" href="editProfile.php"
                                    target=""><span>Edit profile</span></a></li>
                            <li class="nav-item"><a class="nav-link px-2 text-muted" href="editPassword.php"
                                    target=""><span>Change password</span></a></li>
                            <li class="nav-item"><a class="nav-link px-2 active" href="editSocials.php"
                                    target=""><span><strong>Socials</strong></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card p-3 mt-3">
                    <div class="e-navlist e-navlist--active-bg">
                        <form id="logout" class="mb-0" action="" method="post">
                            <input type="submit" class="btn btn-danger w-100" name="delete" value="Delete account">
                        </form>
                    </div>
                </div>
            </div>
            <div class=" col-12 col-lg-10 mb-3">
                <div class="card p-3">
                    <div class="e-navlist e-navlist--active-bg">
                        <form action="" class="" method="post">
                            <?php if(isset($succes)): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $succes; ?>
                            </div>
                            <?php endif; ?>
                            <div class="mb-3">
                                <label class="mb-1" for="socialLink">Social Link</label>
                                <div class="form">
                                    <input type="text" name="socialLink" class="form-control p-3" id="socialLink"
                                        placeholder="Enter your social link" value="" required>
                                </div>
                                <label class="mb-1 mt-3" for="platform">Platform</label>
                                <div class="form">
                                    <input type="text" name="platform" class="form-control p-3" id="platform"
                                        placeholder="Enter your social platform" value="" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="addSocials" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>