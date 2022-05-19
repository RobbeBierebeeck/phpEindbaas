<?php
namespace Drop\Core;

use Drop\Core\DB;

class User
{
    private $userId;
    private $reportedId;

    /**
     * Get the value of reportedId
     */ 
    public function getReportedId()
    {
        return $this->reportedId;
    }

    /**
     * Set the value of reportedId
     *
     * @return  self
     */ 
    public function setReportedId($reportedId)
    {
        $this->reportedId = $reportedId;
        return $this;
    }

    /**
     * Get the value of userId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */ 
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    public function save(){
        $conn = DB::getConnection();
        $statement = $conn->prepare("insert into warned_users (userId, reportedId, created_at) values (:userId, :warnedId, NOW())");
        $statement->bindValue(':userId', $this->userId);
        $statement->bindValue(':reportedId', $this->reportedId);
        $statement->execute();
    }
}
