<?php

namespace Drop\Core;

include_once(__DIR__ . '/../../../vendor/autoload.php');

use Drop\Core\DB;
use PDO;
use Exception;

class Followers
{
    private $user_id;
    private $follower_id;


    /**
     * Get the value of user_Id
     */ 
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_Id
     *
     * @return  self
     */ 
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

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

    public function saveFollow(){
        $conn = DB::getConnection();
        $statement = $conn->prepare("insert into followers (active, following_id, follower_id) values (:active, :following_id, :follower_id)");
        $statement->bindValue(":active", 1);
        $statement->bindValue(':following_id', $this->user_id);
        $statement->bindValue(':follower_id', $this->follower_id);
        $statement->execute();
    }

    public static function getAllFollowers($userId)
    {

    }

    public static function deleteFollowers($userId, $followerId){
        $conn = DB::getConnection();
        $statement = $conn->prepare("delete from followers where following_id = :following_id and follower_id = :follower_id");
        $statement->bindValue(":following_id", $userId);
        $statement->bindValue(":follower_id", $followerId);
        $statement->execute();
    }

    public static function getFollowerStatus($userId, $followerId)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("select * from Followers where following_id = :following_id and follower_id = :follower_id");
        $statement->bindValue(":following_id", $userId);
        $statement->bindValue(":follower_id", $followerId);
        $statement->execute();
        $result = $statement->fetchAll();
        if(count($result) == null){
            $result = "follow";
        }else{
            $result = "following";
        }
        return $result;

    }
}