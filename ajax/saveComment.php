<?php

use Drop\Core\Comment;
use Drop\Helpers\Security;
use Drop\Core\User;

include_once(__DIR__ . '/../vendor/autoload.php');
Security::onlyLoggedInUsers();
if (!empty($_POST)) {
    $comment = $_POST['comment'];
    $postId = $_POST['postId'];
    try {
        $c = new Comment();
        $c->setComment($comment);
        $c->setUserId(User::getUserId($_SESSION['user']));
        $c->setProjectId($postId);
        $c->save();
        $id = $c->getId();
        $userId = User::getUserId($_SESSION['user']);
        $data = User::getByComment($id, $userId);

        $result = [
            "status" => "success",
            "message" => htmlspecialchars($comment),
            "data" => [
                "comment" => htmlspecialchars($comment),
                "id" => $id,
                "user" => $userId,
                "userData" => $data
            ]
        ];
    } catch (Throwable $t) {
        $result = [
            "status" => "error",
            "message" => "Something went wrong"
        ];
    }
    echo json_encode($result);
}

