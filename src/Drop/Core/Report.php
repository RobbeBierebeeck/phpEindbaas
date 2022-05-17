<?php

namespace Drop\Core;

class Report
{
    private $user_id;
    private $report_id;

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

}