<?php



use Drop\Core\Password;
use Drop\Core\User;
use Postmark\PostmarkClient;
include_once('vendor/autoload.php');

if (!empty($_POST)) {

    try {
        $client = new PostmarkClient("037cc838-cbc3-40e5-97c9-3e41094be977");
        $fromEmail = "hey@localleaves.be";
        $toEmail = $_POST['email'];
        $subject = "Password recovery";
        $textBody = "Password recovery";
        $tag = "example-email-tag";
        $trackOpens = true;
        $trackLinks = "None";
        $messageStream = "outbound";

        $code = uniqid(true); //generating random code

        // Setting the email content

        $url = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/newPassword.php?code=" . $code;
        $htmlBody = "<h1>You requested a password reset</h1>
                        <p>Click <a href= '$url'>this link</a> to reset your password</p>";

        if (User::findByEmail($_POST["email"])) {
            // Send an email:
            $sendResult = $client->sendEmail(
                $fromEmail,
                $toEmail,
                $subject,
                $htmlBody,
                $textBody,
                $tag,
                $trackOpens,
                NULL, // Reply To
                NULL, // CC
                NULL, // BCC
                NULL, // Header array
                NULL, // Attachment array
                $trackLinks,
                NULL, // Metadata array
                $messageStream
            );
            $send = "Check your inbox";
            Password::setResetData(User::getUserId($_POST["email"]), $code);
        } else $send = "Check your inbox";


    } catch (\Exception $e) {

        $e = $e->getMessage();
    }
}
?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>password recovery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
<div class=" vw-100 vh-100 d-flex flex-column justify-content-center align-items-center">
    <form action="" method="post" class="col-8 col-sm-8 col-lg-6 col-xl-6 col-xxl-4 container d-flex flex-column ">
        <div class="d-flex flex-column align-items-center"><img class="mb-4" src="images/logo.svg" alt="" width="72"
                                                                height="57">
            <h1 class="h3 mb-3 fw-normal">Reset your password</h1>
        </div>
        <?php if (isset($e)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $e ?>
            </div>
        <?php endif; ?>
        <?php if (isset($send)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $send ?>
            </div>
        <?php endif; ?>
        <div class="form-floating">
            <input type="email" class="form-control" id="emailInput" placeholder="name@example.com" required
                   name="email">
            <label for="emailInput">Email</label>
        </div>
        <div class="col-12 pt-3">
            <button type="submit" class="btn btn-primary">Send email</button>
        </div>
        <span class="pt-1">or <a href="">login</a></span>
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