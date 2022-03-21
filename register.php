<?php
include_once(__DIR__ . '/bootstrap.php');
$conn = DB::getConnection();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <title>Register</title>
</head>
<body>
<div class="vh-100 vw-100 d-flex flex-column justify-content-center align-items-center">
    <img class="mb-4" src="images/logo.svg" alt="" width="72" height="57">
    <h1>Create an account</h1>
    <p>Start your journey!</p>
    <form class="row g-3 mx-0 col-8 col-sm-8 col-lg-6 col-xl-6 col-xxl-4">
        <div class="mb-3">
            <label>Leakable data</label>
            <div class="form-floating">
                <input type="email" class="form-control" id="emailInput" placeholder="name@example.com" required>
                <label for="emailInput">Enter your email adress*</label>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <label>Should not be leaked</label>
            <div class="form-floating mb-2">
                <input type="password" class="form-control" id="password" placeholder="name@example.com" required>
                <label for="password">Enter your password*</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="passwordConf" placeholder="name@example.com" required>
                <label for="passwordConf">Confirm your password*</label>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <label>Personal info</label>
            <div class="d-flex justify-content-between">
            <div class="form-floating col-6 pe-1.5 pe-1">
                <input type="text" class="form-control" id="firstName" placeholder="name@example.com" required>
                <label for="firstName">Enter your firstname*</label>
            </div>
            <div class="form-floating col-6 ps-1.5 ps-1">
                <input type="password" class="form-control" id="firstLastname" placeholder="name@example.com" required>
                <label for="firstLastname">Enter your lastname*</label>
            </div>
            </div>
        </div>
        <div class="">
            <div class="">
                <label for="formFile" class="form-label">Upload a profile picture</label>
                <input class="form-control" type="file" id="formFile">
            </div>
        </div>
        <div class="col-12 pt-3">
            <button type="submit" class="btn btn-primary">Verstuur email</button>
        </div>
    </form>
</div>
</body>
</html>
