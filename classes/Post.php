<?php

include_once(__DIR__ . '/../bootstrap.php');
include_once(__DIR__ . '/../vendor/autoload.php');
include_once(__DIR__ . '/../config/configCloud.php');

use Cloudinary\Api\Upload\UploadApi;

class Post
{
    private $id;
    private $tags;
    private $title;
    private $description;
    private $image;
    private $userId;
    private $enableViews;

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

    /**
     * @return mixed
     */
    public function getEnableViews()
    {
        return $this->enableViews;
    }

    /**
     * @param mixed $enableViews
     */
    public function setEnableViews($enableViews): void
    {
        $this->enableViews = $enableViews;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;

    }

    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        if (strlen($title) > 0) {
            $this->title = $title;
        } else {
            throw new Exception("Title can't be empty");
        }

    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;

    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        if ($image !== null) {
            $image= (new UploadApi())->upload($image['tmp_name'], ['public_id' => $image['name'], "folder" => "posts"]);
            $this->image = $image['url'];
        } else {
            throw new Exception("Image can't be empty");
        }


    }


    public function save()
    {
        //saving the post
        $conn = DB::getConnection();
        $statement = $conn->prepare("INSERT INTO Projects (title,image , description,posted_at , user_id,private_views) VALUES (:title,:image ,:description,NOW(), :user_id, :private_views)");
        $statement->bindParam(':title', $this->title);
        $statement->bindParam(':image', $this->image);
        $statement->bindParam(':description', $this->description);
        $statement->bindParam(':user_id', $this->userId);
        $statement->bindParam(':private_views', $this->enableViews);
        $statement->execute();
        $this->id = $conn->lastInsertId();

        //saving tags
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
            $statement->bindValue(':project_id', $this->id);
            $statement->execute();
        }

    }
}