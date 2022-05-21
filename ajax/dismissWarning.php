<?php
use Drop\Core\Warning;

require_once(__DIR__ . "/../vendor/autoload.php");

if (!empty($_POST)) {
    $userId = $_POST['userId'];

    try {
        Warning::updateWarning($userId);
        $result = [
            "status" => "success",
            "message" => "agreed to warning implications"
        ];
    } catch (Throwable $t) {
        $result = [
            "status" => "error",
            "message" => "Something went wrong."
        ];
    }
    echo json_encode($result);
}