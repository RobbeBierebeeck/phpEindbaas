<?php
namespace Drop\Core;

include_once (__DIR__.'/../../../vendor/autoload.php');
use Drop\Core\DB;

class Warning
{
    private $userId;
    private $warnedId;

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

    /**
     * Get the value of warnedId
     */ 
    public function getWarnedId()
    {
        return $this->warnedId;
    }

    /**
     * Set the value of warnedId
     *
     * @return  self
     */ 
    public function setWarnedId($warnedId)
    {
        $this->warnedId = $warnedId;
        return $this;
    }

    public function saveWarning(){
        $conn = DB::getConnection();
        $statement = $conn->prepare("insert into warned_users (user_id, warned_id, warned_at, status) values (:userId, :warnedId, NOW(), :status)");
        $statement->bindValue(':userId', $this->userId);
        $statement->bindValue(':warnedId', $this->warnedId);
        $statement->bindValue(':status', "pending");
        $statement->execute();
    }

    public static function getUserWarnings($reportedUser){
        $conn = DB::getConnection();
        $statement = $conn->prepare("select * from warned_users where warned_id = :id");
        $statement->bindValue(":id", $reportedUser);
        $statement->execute();
        $result = $statement->fetchAll();
        return count($result);
    }

    public static function updateWarning($userId){
        $conn = DB::getConnection();
        $statement = $conn->prepare("update warned_users set status = :status where warned_id = :warnedId");
        $statement->bindValue(':status', "agreed");
        $statement->bindValue(':warnedId',$userId);
        $statement->execute();
    }
}
