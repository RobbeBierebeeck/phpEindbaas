<?php
include_once(__DIR__.'/../vendor/autoload.php');
use Drop\Core\Followers;
use Drop\Core\User;
use Drop\Helpers\Security;

Security::onlyLoggedInUsers();

//var_dump($_POST);

if (!empty($_POST)) {

    $userId = $_POST['targetUserId'];

    try {
        if (Followers::getFollowerStatus($userId, User::getUserId($_SESSION["user"])) == "following") {
            Followers::deleteFollowers($userId, User::getUserId($_SESSION["user"]));
            $response = [
                "followStatus" => "follow",
                "message" => "unfollow successfully"
            ];
        } else {
            $follower = new Followers();
            $follower->setUser_id($userId);
            $follower->setFollower_id(User::getUserId($_SESSION["user"]));
            $follower->saveFollow();
    
            $response = [
                "followStatus" => "following",
                "message" => "followed successfully",
            ];
        }
    } catch (Exception $e) {
        $response = [
            'status' => 'error',
            'message' => $e->getMessage()
        ];
    }
    echo json_encode($response);
}