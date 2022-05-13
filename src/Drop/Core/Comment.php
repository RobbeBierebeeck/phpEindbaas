<?php

namespace Drop\Core;

use Drop\Core\DB;
use PDO;

include_once(__DIR__ . '/../../../vendor/autoload.php');

class Comment
{
    private $id;
    private $commentId;
    private $comment;
    private $projectId;
    private $userId;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCommentId()
    {
        return $this->commentId;
    }

    /**
     * @param mixed $commentId
     */
    public function setCommentId($commentId)
    {
        $this->commentId = $commentId;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
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
    public function setProjectId($projectId)
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
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public static function getAll($projectId)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("select Comments.`comment`, Users.`firstname`, Users.`lastname`, Users.`profile_image` from comments 
inner join Users on Comments.`user_id` = Users.`id`
where  Comments.`project_id` = :projectId");
        $statement->bindValue(':projectId', $projectId, PDO::PARAM_INT);
        $statement->execute();
        // fetch all records from the database and return them as objects of this __CLASS__ (Post)
        return $statement->fetchAll();
    }

    public function Save()
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("INSERT INTO comments (comment, project_id, user_id) VALUES (:comment, :project_id, :user_id)");
        $statement->bindValue(':comment', $this->comment);
        $statement->bindValue(':project_id', $this->projectId);
        $statement->bindValue(':user_id', $this->userId);
        $statement->execute();
        $this->id = $conn->lastInsertId();
    }

    public static function deleteComments($id)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("delete Comments from Users INNER JOIN Comments on Users.id = Comments.user_id WHERE Users.id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
    }
}