<?php
use Drop\Helpers\Security;
use Drop\Core\Report;
use Drop\Core\User;
include_once(__DIR__.'/../vendor/autoload.php');

Security::onlyLoggedInUsers();

if (!empty($_POST)){

    $userId = $_POST['userId'];

    try {
        if(User::checkIfReported(User::getUserId($_SESSION['user']) , $userId)) {
            $result = [
                'status ' => 'failed',
                'message' => 'You have already reported this user'
            ];
        }else {
            $report = new Report();
            $report->setUserId(User::getUserId($_SESSION['user']));
            $report->setReportId($userId);
            $report->saveUserReport();
            $result = [
                'status ' => 'success',
                'message' => 'User reported successfully'
            ];
        }

    }catch (Exception $e){
        $result = [
            'status' => 'error',
            'message' => $e->getMessage()
        ];

    }
    echo json_encode($result);
}