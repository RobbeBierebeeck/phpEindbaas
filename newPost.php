<?php
    include_once (__DIR__.'/helpers/Security.php');
    include_once (__DIR__.'/bootstrap.php');

 Security::onlyLoggedInUsers();

    if (!empty($_POST)){


        try {
            $post = new Post();
            $post->setTitle($_POST['title']);
            $post->setDescription($_POST['description']);
            $post->setUserId(User::getUserId($_SESSION['user']));
            $post->setImage($_FILES['file']);
            if (isset($_POST['views'])){
                $post->setEnableViews(1);
            }
            else{
                $post->setEnableViews(0);
            }
            $post->save();
        } catch (Throwable $e) {
            $error= $e->getMessage();
        }


    }
?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
<div class="container vw-100 vh-100 d-flex justify-content-center align-items-center">
    <div class="row">
        <div class="col-md-12">
            <h1>Ready to drop a post?</h1>
            <?php if (isset($error)):?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error?>
            </div>
            <?php endif;?>
            <form enctype="multipart/form-data" action="#" method="post">
                <div class="form-group mt-3">
                    <label for="formFile" class="form-label">Drop your shot</label>
                    <input class="form-control" name="file" type="file" id="formFile" accept=".png,.gif,.jpg,.webp">
                </div>
                <!-- Tag input feeld -->
                <div class="mt-3">
                    <label class="form-label" for="floatingInput">Tags</label>
                    <div class="input form-control" id="floatingInput">
                        <div class="input__tags"></div>
                        <input type="text"  id="tags">
                    </div>
                </div>
                <input type="text" name="tags" id="tags-fake">
                <!-- Title input feeld -->
                <div class="form-group mt-3">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <!-- Content input feeld -->
                <div class="form-group mt-3">
                    <label for="content">Content</label>
                    <textarea class="form-control" id="content" name="description" rows="3" ></textarea>
                </div>
                <!--- Checkbox -->
                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="views">
                    <label class="form-check-label" for="flexCheckDefault" >
                        Make views public
                    </label>
                </div>
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary mt-3">Drop it</button>
            </form>
        </div>
    </div>
    <script src="scripts/tags.js"></script>
</body>
</html>
