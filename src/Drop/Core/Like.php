<?php

namespace Drop\Core;
use Drop\Core\DB;

include_once (__DIR__.'/../../../vendor/autoload.php');
class Like
{
    private $projectId;
    private $userId;
    private $status;

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * @param mixed $projectId
     */
    public function setProjectId($projectId): void
    {
        $this->projectId = $projectId;
    }

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

    public function save()
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("INSERT INTO likes (project_id, user_id, status) VALUES (:project_id, :user_id, :status)");
        $statement->bindValue(':project_id', $this->projectId);
        $statement->bindValue(':user_id', $this->userId);
        $statement->bindValue(':status', $this->status);
        $statement->execute();

    }
    public static function deleteLikes($id)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("delete Likes from Users INNER JOIN Likes on Users.id = Likes.user_id WHERE Users.id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
    }

    public static function isLiked($postId, $userId)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("SELECT * FROM likes WHERE user_id = :user_id AND project_id = :project_id and status = 1");
        $statement->bindValue(":user_id", $userId);
        $statement->bindValue(":project_id", $postId);
        $statement->execute();
        return $statement->fetch();
    }


    public static function getLikes($postId)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("SELECT count(user_id) as likes FROM likes WHERE project_id = :project_id and status = 1");
        $statement->bindValue(":project_id", $postId);
        $statement->execute();
        return $statement->fetch();
    }

    public static function getLike($postId, $userId)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("SELECT * FROM likes WHERE user_id = :user_id AND project_id = :project_id");
        $statement->bindValue(":user_id", $userId);
        $statement->bindValue(":project_id", $postId);
        $statement->execute();
        return $statement->fetch();
    }

    public static function updateStatus($postId, $userId, $status)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("UPDATE likes SET status = :status WHERE user_id = :user_id AND project_id = :project_id");
        $statement->bindValue(":user_id", $userId);
        $statement->bindValue(":project_id", $postId);
        $statement->bindValue(":status", $status);
        $statement->execute();

    }

}