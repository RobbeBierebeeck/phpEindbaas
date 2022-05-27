<?php
use Drop\Helpers\Security;
use Drop\Core\Report;
use Drop\Core\Post;
include_once(__DIR__.'/../vendor/autoload.php');

Security::onlyLoggedInUsers();

if (!empty($_POST)){

    $projectId = $_POST['projectId'];
    $userId = $_POST['userId'];

    try {
        if (Report::canReportProject($projectId, $userId) != null) {
            $result = [
                'status ' => 'failed',
                'message' => 'already reported project'
            ];
        } else {
            $report = new Report();
            $report->setProject_id($projectId);
            $report->setUserId($userId);
            $report->saveProjectReport();
            $result = [
                'status ' => 'success',
                'message' => 'project reported'
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