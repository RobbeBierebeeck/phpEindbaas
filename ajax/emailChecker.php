<?php
include_once ('./../vendor/autoload.php');
use Drop\Core\User;

if (!empty($_POST["email"])){
    try {
        if (count(User::checkEmailAvailability(htmlspecialchars($_POST["email"]))) > 0) {
                $response = [
                    "message" => "this email is already in use"
                ];
        }else {
            $response = [
                "message" => "email available"
            ];
        }
        
    } catch (Exception $e){
        $response = [
            "message" => $e->getMessage()
        ];
    }
    echo json_encode($response);
}
