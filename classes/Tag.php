<?php
include_once (__DIR__.'/../bootstrap.php');
class Tag
{
private $tags;
private $projectId;

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
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags): void
    {
        $tags = explode(',', $tags);
        $this->tags = $tags;
    }

    public static function findTag($tag)
    {
        $conn = DB::getConnection();
        $statement = $conn ->prepare('SELECT * FROM Tags WHERE tag = :tag');
        $statement->bindValue(':tag', $tag);
        $statement->execute();
        return $statement->fetch();


    }

    public function save()
    {
        //saving tags to database
        $conn = DB::getConnection();
        $statement = $conn->prepare("insert into Tags(tag) values (:tag)");
        if ($this->tags != null) {
            foreach ($this->tags as $tag) {
                if(!self::findTag($tag)){
                    $statement->bindValue(':tag', $tag);
                    $statement->execute();
                }
            }
        }
        //saving the many to many relationship between tags and posts
        foreach ($this->tags as $tag) {
            $statement = $conn->prepare("insert into Project_Tags(tag_id, project_id) values ((select id from Tags where tag = :tag), :project_id)");
            $statement->bindValue(':tag', $tag);
            $statement->bindValue(':project_id', $this->projectId);
            $statement->execute();
        }

    }
}