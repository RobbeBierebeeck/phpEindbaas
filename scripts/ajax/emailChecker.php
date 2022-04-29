<?php
include_once ('../../vendor/autoload.php');
use Drop\Core\DB;

if (!empty($_POST["email"])){
    $conn = DB::getConnection();
    $statement = $conn->prepare("select email from Users where email = :email");
    $statement->bindValue("email", htmlspecialchars($_POST["email"]));
    $statement->execute();
    $results = $statement->fetchAll();
    
    if (count($results) > 0) {
        $response = [
            "message" => "this email is already in use"
        ];
    } 
    else {
        $response = [
            "message" => "email available"
        ];
    }
    echo json_encode($response);
}