<?php
include_once(__DIR__ . '/helpers/Security.php');
include_once(__DIR__ . '/bootstrap.php');
Security::onlyLoggedInUsers();
$profileImg = User::getProfilePicture();
var_dump($profileImg);
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
    <title>account settings</title>
</head>

<body>
    <div class="vh-100 vw-100 d-flex flex-column justify-content-center align-items-center">
        <img class="mb-4" src="<?php echo $profileImg ?>" alt="" width="72" height="57">
        <h1></h1>
        <p>edit your preferences</p>
        <div>
            <div class="mb-3">
                <label for="profilePic">Change profile picture</label>
                <input type="file" name="profilePic" class="form-control" id="profilePic" accept=".png,.gif,.jpg,.webp">
            </div>
            <div class="col-12 pt-3">
                <button type="submit" class="btn btn-primary">change profile picture</button>
            </div>
        </div>
        </form>
    </div>
</body>

</html>