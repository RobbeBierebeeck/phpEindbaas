<?php
include_once(__DIR__ .'/bootstrap.php');
try {
    if (!empty($_GET)){
       PasswordTemp::isExpired($_GET['code']);
    }
    if (!isset($_GET['code'])) {
        throw new Exception("Can't find page you are lookig for...");
    }
    if (!empty($_POST)) {
        if (User::checkPasswords($_POST["password"], $_POST['passwordConf'])) {
            PasswordTemp::updatePassword($_GET['code'], User::hashPassword($_POST['password']));
           PasswordTemp::deletePasswordReset($_GET['code']);
           $reset = "Your password is successfully reset please <a href='login.php'>login</a> again";
        }
    }
} catch (Throwable $e) {
    $e = $e->getMessage();
}

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>reset password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>

<div class="vh-100 vw-100 d-flex flex-column justify-content-center align-items-center">
    <img class="mb-4" src="images/logo.svg" alt="" width="72" height="57">
    <h1>Reset your password</h1>
    <p>No worries we all have been here</p>
    <form method="POST" class="row g-3 mx-0 col-8 col-sm-8 col-lg-6 col-xl-6 col-xxl-4" enctype="multipart/form-data">
        <?php if (isset($e)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $e ?>
            </div>
        <?php endif; ?>
        <?php if (isset($reset)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $reset ?>
            </div>
        <?php endif; ?>
        <div class="form-floating mb-2">
            <input type="password" name="password" class="form-control" id="password" placeholder="name@example.com"
                   required>
            <label for="password">Enter your password*</label>
        </div>
        <div class="form-floating">
            <input type="password" name="passwordConf" class="form-control" id="passwordConf"
                   placeholder="name@example.com" required>
            <label for="passwordConf">Confirm your password*</label>
        </div>

        <div class="col-12 pt-3">
            <button type="submit" class="btn btn-primary">Reset password</button>
        </div>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
</body>
</html>