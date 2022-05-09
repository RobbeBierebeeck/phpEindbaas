<?php

use Drop\Core\Like;
use Drop\Core\User;
use Drop\Helpers\Security;
use Drop\Core\Post;

require_once(__DIR__ . "/../vendor/autoload.php");
Security::onlyLoggedInUsers();

if (!empty($_POST)) {
    $postId = $_POST['postId'];

    try {
        if (!Like::getLike($postId, User::getUserId($_SESSION['user']))) {
            $l = new Like();
            $l->setProjectId($postId);
            $l->setUserId(User::getUserId($_SESSION['user']));
            $l->setStatus(1);
            $l->save();
            $like = 1;
        } else if (Like::getLike($postId, User::getUserId($_SESSION['user']))['status'] === "1") {
            Like::updateStatus($postId, User::getUserId($_SESSION['user']), 0);
            $like = 0;
        } else {
            Like::updateStatus($postId, User::getUserId($_SESSION['user']), 1);
            $like = 1;
        }
        // success
        $result = [
            "status" => "success",
            "like" => $like,
            "message" => Like::getLike($postId, User::getUserId($_SESSION['user']))['status']
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