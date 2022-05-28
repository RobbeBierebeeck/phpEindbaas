<?php
include_once ('./../vendor/autoload.php');
use Drop\Core\Invite;

if (!empty($_POST["code"])){
    try {
        $code = $_POST["code"];

        if (Invite::checkCodeValidation($code) == null) {
                $invite = new Invite();
                $invite->setCode($code);
                $invite->generateInvite();
                $invite->saveCode();

                $response = [
                    "message" => "code available",
                    "link" => $invite->generateInvite(),
                ];
        }else {
            $response = [
                "message" => "code already exists"
            ];
        }
        
    } catch (Exception $e){
        $response = [
            "message" => $e->getMessage()
        ];
    }
    echo json_encode($response);
}