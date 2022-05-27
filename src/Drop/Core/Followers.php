<?php

namespace Drop\Core;

include_once(__DIR__ . '/../../../vendor/autoload.php');

use Drop\Core\DB;
use PDO;
use Exception;

class Followers
{
    private $user_Id;
    private $follower_id;


    /**
     * Get the value of user_Id
     */ 
    public function getUser_Id()
    {
        return $this->user_Id;
    }

    /**
     * Set the value of user_Id
     *
     * @return  self
     */ 
    public function setUser_Id($user_Id)
    {
        $this->user_Id = $user_Id;

        return $this;
    }

    /**
     * Get the value of follower_id
     */ 
    public function getFollower_id()
    {
        return $this->follower_id;
    }

    /**
     * Set the value of follower_id
     *
     * @return  self
     */ 
    public function setFollower_id($follower_id)
    {
        $this->follower_id = $follower_id;

        return $this;
    }

    public static function getFollowerStatus($targetUser, $sessionUser)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("select * from Followers where following_id = :following_id and follower_id = :follower_id");
        $statement->bindValue(":following_id", $targetUser);
        $statement->bindValue(":follower_id", $sessionUser);
        $statement->execute();
        $result = $statement->fetchAll();
        if (count($result) > 0) {
            $followStatus = "following";
            return $followStatus;
        } else {
            $followStatus = "follow";
            return $followStatus;
        }
    }
}