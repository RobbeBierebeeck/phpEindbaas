<?php
include_once(__DIR__ . '/helpers/Security.php');
include_once(__DIR__ . '/bootstrap.php');
Security::onlyLoggedInUsers();
$profileImg = User::getProfilePicture($_SESSION['user']);
$id = User::getUserId($_SESSION['user']);
$userData = User::getById($id);
if (isset($_POST['delete'])) {
    Comment::deleteComments($id);
    Like::deleteLikes($id);
    Password::deletePasswordTemp($id);
    Post::deleteCloudinary($id);
    Post::deleteProjects($id);
    Report::deleteReportedUsers($id);
    Socials::deleteSocialLinks($id);
    User::deleteFollowers($id);
    User::deleteUser($id);
    session_destroy();
    header('Location: logout.php');
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
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
</head>

<body>
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
                                class="text-muted">/</i><strong> General</strong></p>
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
                        <li class="nav-item"><a class="nav-link px-2 active"
                                                href="settings.php"><span><strong>General</strong></span></a></li>
                        <li class="nav-item"><a class="nav-link px-2 text-muted" href="editProfile.php" target=""><span>Edit profile</span></a>
                        </li>
                        <li class="nav-item"><a class="nav-link px-2 text-muted" href="editPassword.php"
                                                target=""><span>Change password</span></a></li>
                        <li class="nav-item"><a class="nav-link px-2 text-muted" href="editSocials.php" target=""><span>Socials</span></a>
                        </li>
                    </ul>
                </div>
            </div>
                <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalToggleLabel">Delete account</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="w-100">
                                <img class="w-100" src="upload/deleteAccount.gif" alt="delete account gif">
                            </div>
                            <div class="modal-body">
                                You are about to delete your account. Are you sure?
                            </div>
                            <div class="modal-footer">
                                <form id="logout" class="mb-0" action="" method="post">
                                    <button type="submit" class="btn btn-danger w-100" name="delete">Delete my account</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="card p-3 mt-3">
                <div class="e-navlist e-navlist--active-bg">
                    <a class="btn btn-danger w-100" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Delete account</a>
                </div>
            </div>
        </div>
        <div class=" col-12 col-lg-10 mb-3">
            <div class="card p-3">
                <div class="e-navlist--active-bg">
                    <form action="" class="" method="post">
                        <div class="mb-3">
                            <label class="mb-1">Username</label>
                            <div class="form">
                                <input type="text" name="username" class="form-control p-3" id="usernameInput" placeholder="Username" value="<?php echo $userData['firstname']; echo $userData['lastname'];?>" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="mb-1">Email</label>
                            <div class="form">
                                <input type="text" name="username" class="form-control p-3" id="usernameInput" placeholder="Username" value="<?php echo $userData['email']; ?>" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>

</html>