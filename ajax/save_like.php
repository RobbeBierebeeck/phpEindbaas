<?php

use Drop\Core\Like;
use Drop\Core\User;
use Drop\Helpers\Security;
require_once (__DIR__."/../vendor/autoload.php");
Security::onlyLoggedInUsers();
if( !empty($_POST) ) {
   $postId = $_POST['postId'];

    try {
        $l = new Like();
       $l->setProjectId($postId);
       $l->setUserId(User::getUserId($_SESSION['user']));
       $l->save();

        // success
        $result = [
            "status" => "success"
        ];

    } catch( Throwable $t ) {
        // error
        $result = [
            "status" => "error",
            "message" => "Something went wrong."
        ];
    }

    echo json_encode($result);

}