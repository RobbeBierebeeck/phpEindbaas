<?php
use Drop\Helpers\Security;
use Drop\Core\Report;
use Drop\Core\Post;
include_once(__DIR__.'/../vendor/autoload.php');

Security::onlyLoggedInUsers();

if (!empty($_POST)){

    $projectId = $_POST['projectId'];

    try {
        $report = new Report();
        $report->setProject_id($projectId);
        $report->saveProjectReport();
        $result = [
            'status ' => 'success',
            'message' => 'project reported'
        ];
    }catch (Exception $e){
        $result = [
            'status' => 'error',
            'message' => $e->getMessage()
        ];
    }
    echo json_encode($result);
}