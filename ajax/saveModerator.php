<?php
include_once ('./../vendor/autoload.php');
use Drop\Core\DB;

if (!empty($_POST)) {
    if($_POST['role'] == "User"){
        $conn = DB::getConnection();
        $statement = $conn->prepare("update users set role = :role where id = :id ");
        $statement->bindValue("id", $_POST['userId']);
        $statement->bindValue("role", $_POST['role']);
        $statement->execute();

        $response = [
            "modStatus" => "set moderator",
            "message" => "unset from moderator list",
            "data" => $_POST
        ];
    }
    
    if($_POST['role'] == "Moderator"){
        $conn = DB::getConnection();
        $statement = $conn->prepare("update users set role = :role where id = :id ");
        $statement->bindValue("id", $_POST['userId']);
        $statement->bindValue("role", $_POST['role']);
        $statement->execute();

        $response = [
            "modStatus" => "remove from moderation",
            "message" => "added to moderator list",
            "data" => $_POST,
        ];
    }
    
    echo json_encode($response);
}