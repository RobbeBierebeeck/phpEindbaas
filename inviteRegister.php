<?php

use Drop\Core\User;
use Drop\Core\Invite;
include_once ('vendor/autoload.php');

if(!empty($_GET['code'])){
    $codeOk = Invite::checkLinkCode(($_GET['code']));
}

if (!empty($_POST)) {
    try {
        $user = new User();
        $user->setAlumniEmail($_POST['email']);
        $user->setPassword($_POST['password'], $_POST['passwordConf']);
        $user->setFirstName($_POST['firstName']);
        $user->setLastName($_POST['lastName']);
        $user->setProfilePicture($_FILES['profilePic']);
        if (!User::findByEmail($_POST['email'])) {
            $user->save();
            Invite::deleteCode($_GET['code']);
            session_start();
            $_SESSION['user'] = $user->getEmail();
            header("Location:index.php");
        } else throw new Exception("User already exists.");
    } catch (Throwable $e) {
        $error = $e->getMessage();
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Register</title>
</head>

<body>
    <?php if (isset($codeOk) && $codeOk) : ?>
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <div class="vh-100 vw-100 d-flex flex-column justify-content-center align-items-center">
            <img class="mb-4" src="images/logo.svg" alt="" width="72" height="57">
            <h1>Create an account</h1>
            <p>Start your journey!</p>
            <form method="POST" class="row g-3 mx-0 col-8 col-sm-8 col-lg-6 col-xl-6 col-xxl-4" enctype="multipart/form-data">
                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <div class="mb-3 needs-validation">
                    <label>Leakable data</label>
                    <div class="form-floating">
                        <input type="email" name="email" class="form-control email" id="emailInput" placeholder="name@example.com" required>
                        <label for="emailInput">Enter your email adress*</label>
                        <div class="email-validator"></div>
                    </div>
                </div>
                <div class="mt-3 mb-3">
                    <label>Should not be leaked</label>
                    <div class="form-floating mb-2">
                        <input type="password" name="password" class="form-control" id="password" placeholder="name@example.com" required>
                        <label for="password">Enter your password*</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" name="passwordConf" class="form-control" id="passwordConf" placeholder="name@example.com" required>
                        <label for="passwordConf">Confirm your password*</label>
                    </div>
                </div>
                <div class="mt-3 mb-3">
                    <label>Personal info</label>
                    <div class="d-flex justify-content-between">
                        <div class="form-floating col-6 pe-1.5 pe-1">
                            <input type="text" name="firstName" class="form-control" id="firstName" placeholder="name@example.com" required>
                            <label for="firstName">Enter your firstname*</label>
                        </div>
                        <div class="form-floating col-6 ps-1.5 ps-1">
                            <input type="text" name="lastName" class="form-control" id="firstLastname" placeholder="name@example.com" required>
                            <label for="firstLastname">Enter your lastname*</label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="firstLastname">Choose profile picture</label>
                    <input type="file" name="profilePic" class="form-control" id="profilePic" accept=".png,.gif,.jpg,.webp">
                </div>
                <div class="col-12 pt-3">
                    <button type="submit" class="btn btn-primary">Verstuur email</button>
                </div>
            </form>
        </div>
    <?php endif; ?>

    <?php if (empty($_GET['code']) || !$codeOk) : ?>
        <div class="alert alert-danger">invalid link: unfortunately this link is unavailable or has already been used, try another one</div>
    <?php endif; ?>

</body>
</html>