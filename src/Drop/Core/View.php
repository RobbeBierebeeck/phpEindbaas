<?php

namespace Drop\Core;
use Drop\Core\DB;

include_once (__DIR__.'/../../../vendor/autoload.php');

class View
{

    private $ip;
    private $postId;
    private $userId;

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param mixed $ip
     */
    public function setIp($ip): void
    {
        $this->ip = $ip;
    }

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * @param mixed $postId
     */
    public function setPostId($postId): void
    {
        $this->postId = $postId;
    }

    public function save()
    {
        $conn = DB::getConnection();
        $stmt = $conn->prepare("INSERT INTO `views` (`ip`, `project_id`, `user_id`) VALUES (:ip, :post_id, :user_id)");
        $stmt->bindValue(':ip', $this->getIp());
        $stmt->bindValue(':post_id', $this->getPostId());
        $stmt->bindValue(':user_id', $this->getUserId());
        $stmt->execute();
    }

    public static function alreadyViewed($ip, $postId, $userId)
    {
        $conn = DB::getConnection();
        $stmt = $conn->prepare("SELECT * FROM views WHERE ip = :ip AND project_id = :post_id AND user_id = :user_id");
        $stmt->bindValue(':ip', $ip);
        $stmt->bindValue(':post_id', $postId);
        $stmt->bindValue(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetch();
    }

}