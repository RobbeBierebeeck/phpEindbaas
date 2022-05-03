<?php

namespace Drop\Core;
use Drop\Core\DB;

include_once (__DIR__.'/../../../vendor/autoload.php');
class Like
{
    private $projectId;
    private $userId;

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
        $statement = $conn->prepare("INSERT INTO likes (project_id, user_id) VALUES (:project_id, :user_id)");
        $statement->bindValue(':project_id', $this->projectId);
        $statement->bindValue(':user_id', $this->userId);
        $statement->execute();

    }
    public static function deleteLikes($id)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("delete Likes from Users INNER JOIN Likes on Users.id = Likes.user_id WHERE Users.id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
    }
}