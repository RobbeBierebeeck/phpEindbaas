<?php
include_once ('./../vendor/autoload.php');
use Drop\Core\User;


if (!empty($_POST)) {
    $userId = $_POST['userId'];
    $status;
    try {
        if(User::getModStatus($_POST['userId'])['role'] == 'Moderator') {
            $status = "User";
            User::updateUserStatus($_POST['userId'], $status);
            $result = [
                "modStatus" => "set moderator",
                "message" => "unset from moderator list"
            ];
        }else{
            $status = "Moderator";
            User::updateUserStatus($_POST['userId'], $status);
            $result = [
                "modStatus" => "remove from moderation",
                "message" => "added to moderator list"
            ];
        }
    } catch (Exception $e) {
        $result = [
            'status' => 'error',
            'message' => $e->getMessage()
        ];
    }    
    echo json_encode($result);
}