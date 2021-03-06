<?php

use Drop\Core\Post;
use Drop\Core\XSS;
include_once(__DIR__ . '/vendor/autoload.php');

session_start();
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $posts = Post::getShowcase($id);

} else {
    header('Location: 404.html');
}
?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>showcase</title>
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
<?php include_once (__DIR__.'/partials/header.inc.php')?>
<?php if(!empty($posts)):?>
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 m-auto mt-5 container-lg">
    <?php foreach ($posts as $post): ?>
    <div href="project.php?post=<?php echo $post['id'] ?>" class="col mt-4">
        <div class="card">
            <img src="<?php echo $post['image'] ?>" class="card-img-top" alt="...">
            <div class="card-body d-flex flex-row justify-content-between">
                <h5 class="card-title "><?php echo XSS::specialChars($post['title']) ?></h5>

            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <?php else:?>
<div class="d-flex vw-100 vh-100 align-items-center justify-content-center flex-column"><h3>You have nothing added to you showcase 😬</h3>
<p>please 🙏🏼 go to a post and add it to your showcase ⭐️ to share your amazing work</p></div>
    <?php endif;?>

</div>
</body>
</html>