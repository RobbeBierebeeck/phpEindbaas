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
        $statement = $conn->prepare("insert into warned_users (user_id, reported_id, warned_at) values (:userId, :warnedId, NOW())");
        $statement->bindValue(':userId', $this->userId);
        $statement->bindValue(':warnedId', $this->warnedId);
        $statement->execute();
    }
}
