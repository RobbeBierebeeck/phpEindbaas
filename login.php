<?php
use Drop\Core\User;
include_once ('vendor/autoload.php');


    if (!empty($_POST)) {
        try {
            $user = new User();
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password'],$_POST['password']);
            if ($user->canLogin()) {
                session_start();
                $_SESSION['user'] = $user->getEmail();
                header("Location:index.php");
            }
        }catch (\Throwable $e){
            $error = $e->getMessage();
        }
    
    }

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <title>Login</title>
</head>
<body>

    <div class="vh-100 vw-100 d-flex flex-column justify-content-center align-items-center">
        <img class="mb-4" src="images/logo.svg" alt="" width="72" height="57">
        <h1>Log in to your account!</h1>
        <p>Welcome back! Please enter your details!</p>
        <form method="POST" class="row g-3 mx-0 col-8 col-sm-8 col-lg-6 col-xl-6 col-xxl-4" enctype="multipart/form-data">
            <?php if(isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <div class="mb-3">
                <label>Email</label>
                <div class="form-floating">
                    <input type="email" name="email" class="form-control" id="emailInput" placeholder="name@example.com" required>
                    <label for="emailInput">Enter your email adress*</label>
                </div>
            </div>
            <div class="mt-3 mb-3">
                <label>Password</label>
                <div class="form-floating mb-2">
                    <input type="password" name="password" class="form-control" id="password" placeholder="name@example.com" required>
                    <label for="password">Enter your password*</label>
                </div>
            </div>
            <a class="card-link" href="passwordRecovery.php">Forgot Password</a>
            <div class="col-12 pt-3">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
</body>
</html>