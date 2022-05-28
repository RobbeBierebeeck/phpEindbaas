<?php

namespace Drop\Core;

class Report
{
    private $user_id;
    private $report_id;
    private $project_id;

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getReportId()
    {
        return $this->report_id;
    }

    /**
     * @param mixed $report_id
     */
    public function setReportId($report_id): void
    {
        $this->report_id = $report_id;
    }

    /**
     * Get the value of project_id
     */ 
    public function getProject_id()
    {
        return $this->project_id;
    }

    /**
     * Set the value of project_id
     *
     * @return  self
     */
    public function setProject_id($project_id)
    {
        $this->project_id = $project_id;

        return $this;
    }

    public static function deleteReportedUsers($id)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("delete Reported_users from Users INNER JOIN Reported_users on Users.id = Reported_users.user_id WHERE Users.id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
    }

    public function saveUserReport(){
        $conn = DB::getConnection();
        $statement = $conn->prepare("insert into Reported_users (reported_at, user_id, reported_id) values (now(), :user_id, :reported_id)");
        $statement->bindValue(":user_id", $this->user_id);
        $statement->bindValue(":reported_id", $this->report_id);
        $statement->execute();
    }

    public function saveProjectReport(){
        $conn = DB::getConnection();
        $statement = $conn->prepare("insert into reported_projects (reported_at, project_id, user_id) values (NOW(), :reported_id, :userId)");
        $statement->bindValue(":reported_id", $this->project_id);
        $statement->bindValue(":userId", $this->user_id);
        $statement->execute();
    }

    public static function canReportProject($project_id, $user_id){
        $conn = DB::getConnection();
        $statement = $conn->prepare("select id from reported_projects where project_id = :project_id and user_id = :user_id");
        $statement->bindValue(":project_id", $project_id);
        $statement->bindValue(":user_id", $user_id);
        $statement->execute();
        $response = $statement->fetchAll();
        return count($response);
    }
}