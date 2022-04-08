<?php

include_once(__DIR__ . '/../bootstrap.php');
include_once(__DIR__ . '/../vendor/autoload.php');
include_once(__DIR__ . '/../config/configCloud.php');

use Cloudinary\Api\Upload\UploadApi;

class Post
{
    private $title;
    private $description;
    private $image;
    private $userId;
    private $enableViews;

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
            $image= (new UploadApi())->upload($image['tmp_name'], ['public_id' => $image['name']]);
            $this->image = $image['url'];
        } else {
            throw new Exception("Image can't be empty");
        }


    }



    public function save()
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("INSERT INTO Projects (title,image , description,posted_at , user_id,private_views) VALUES (:title,:image ,:description,NOW(), :user_id, :private_views)");
        $statement->bindParam(':title', $this->title);
        $statement->bindParam(':image', $this->image);
        $statement->bindParam(':description', $this->description);
        $statement->bindParam(':user_id', $this->userId);
        $statement->bindParam(':private_views', $this->enableViews);
        $statement->execute();

    }
}