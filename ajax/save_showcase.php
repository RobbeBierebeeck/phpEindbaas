<?php
use Drop\Core\Post;

include_once (__DIR__.'/../vendor/autoload.php');

if (!empty($_POST)) {
    $postId = $_POST['postId'];

    try {
     if (Post::isShowcase($postId) == 1) {
        Post::updateShowcase($postId, 0);
     }else{
        Post::updateShowcase($postId, 1);
     }

        // success
        $result = [
            "status" => "success",
            "showcase" => Post::isShowcase($postId)
        ];

    } catch (Throwable $t) {
        // error
        $result = [
            "status" => "error",
            "message" => "Something went wrong."
        ];
    }

    echo json_encode($result);

}