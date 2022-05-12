<?php
include_once ('./../vendor/autoload.php');
use Drop\Core\DB;

//var_dump($_POST);

if (!empty($_POST)) {
    if($_POST['active'] == 0){
        $conn = DB::getConnection();
        $statement = $conn->prepare("delete from followers where following_id = :following_id and follower_id = :follower_id");
        $statement->bindValue("following_id", $_POST['targetUserId']);
        $statement->bindValue("follower_id", $_POST['sessionUserId']);
        $statement->execute();

        $response = [
            "followStatus" => "follow",
            "message" => "unfollow successfully",
            "data" => $_POST
        ];
    }
    
    if($_POST['active'] == 1){
        $conn = DB::getConnection();
        $statement = $conn->prepare("insert into followers (active, following_id, follower_id) values (:active, :following_id, :follower_id)");
        $statement->bindValue("active", $_POST['active']);
        $statement->bindValue("following_id", $_POST['targetUserId']);
        $statement->bindValue("follower_id", $_POST['sessionUserId']);
        $statement->execute();

        $response = [
            "followStatus" => "following",
            "message" => "followed successfully",
            "data" => $_POST,
        ];
    }
    
    echo json_encode($response);
}

