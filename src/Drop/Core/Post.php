<?php
namespace Drop\Core;


include_once(__DIR__ . '/../../../config/configCloud.php');
use Cloudinary\Api\Upload\UploadApi;
use Drop\Core\DB;
use PDO;
include_once('vendor/autoload.php');
class Post
{
    private $id;
    private $tags;
    private $title;
    private $description;
    private $image;
    private $userId;
    private $enableViews;
    private $publicId;

    /**
     * @return mixed
     */
    public function getPublicId()
    {
        return $this->publicId;
    }

    /**
     * @param mixed $publicId
     */
    public function setPublicId($publicId): void
    {
        $this->publicId = $publicId;
    }

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
        $statement = $conn->prepare('SELECT * FROM Tags WHERE tag = :tag');
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


        if ($image['size'] !== 0) {
            if (filesize($image['tmp_name']) < 1000000) {
                $image = (new UploadApi())->upload($image['tmp_name'], ["folder" => "posts", "format" => "webp", "quality" => "auto", "aspect_ratio" => "4:3", "width" => "800", "crop" => "fill", "gravity" => "face", "flags" => "progressive"]);
                $this->image = $image['url'];
                $this->setPublicId($image['public_id']);
            } else {
                throw new Exception("Maximum file size is 5MB");
            }
        } else {
            throw new Exception("Image can't be empty");
        }
    }

    public static function deleteCloudinary($userId)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare('SELECT publicId FROM Projects WHERE user_id = :userId');
        $statement->bindValue(':userId', $userId);
        $statement->execute();
        $publicIds = $statement->fetchAll();
        foreach ($publicIds as $publicId) {
            (new UploadApi())->destroy($publicId['publicId']);
        }
    }


    public static function deleteProjectTags($id)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("delete Project_Tags from Projects INNER JOIN Project_Tags on Projects.id = Project_Tags.project_id WHERE Projects.id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
    }

    public static function deleteProjects($id)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("delete Projects from Users INNER JOIN Projects on Users.id = Projects.user_id WHERE Users.id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
    }


    public function save()
    {
        //saving the post
        $conn = DB::getConnection();
        $statement = $conn->prepare("INSERT INTO Projects (title, image, description, posted_at, user_id, private_views, publicId) VALUES (:title, :image, :description, NOW(), :user_id, :private_views, :publicId)");
        $statement->bindParam(':title', $this->title);
        $statement->bindParam(':image', $this->image);
        $statement->bindParam(':description', $this->description);
        $statement->bindParam(':user_id', $this->userId);
        $statement->bindParam(':private_views', $this->enableViews);
        $statement->bindParam(':publicId', $this->publicId);
        $statement->execute();
        $this->id = $conn->lastInsertId();

        //saving tags
        $statement = $conn->prepare("insert into Tags(tag) values (:tag)");
        if ($this->tags != null) {
            foreach ($this->tags as $tag) {
                if (!self::findTag($tag)) {
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


    public static function getAll($start, $limit)

    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("select Projects.`id`, Projects.`title`, Projects.`image`, Projects.`description`, Projects.`posted_at`, Projects.`private_views`, Users.`firstname`, Users.`lastname`, Users.`profile_image` from Projects INNER join Users on Projects.`user_id` = Users.`id`
        order by Projects.`posted_at` desc limit :start, :limit");
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->bindValue(':start', $start, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll();

    }

    public static function search($search, $start, $limit)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("select Projects.`id`, Projects.`title`, Projects.`image`, Projects.`description`, Projects.`posted_at`, Projects.`private_views`, Users.`firstname`, Users.`lastname`, Users.`profile_image` from Projects 
        INNER join Users on Projects.`user_id` = Users.`id`
        INNER join Project_Tags on Projects.`id` = Project_Tags.`project_id`
        INNER join Tags on Project_Tags.`tag_id` = Tags.`id` where Tags.`tag`
        like :search or Projects.`title`like :search or Users.`firstname` like :search or Users.`lastname` like :search
        order by Projects.`posted_at` desc limit :start , :limit");
        $search = "%" . $search . "%";
        $statement->bindValue(':search', $search);
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->bindValue(':start', $start, PDO::PARAM_INT);
        $statement->execute();

        //compares similar array values and removes duplicates
        //Sort_regular flag prevents array from being converted to string and compares the array as it is
        return array_unique($statement->fetchAll(), SORT_REGULAR);

    }

    public static function getUserProjectsById($id)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("select Projects.`id`, Projects.`title`, Projects.`image`, Projects.`description`, Projects.`posted_at`, Projects.`private_views`, Users.`firstname`, Users.`lastname`, Users.`profile_image`
        from Projects INNER join Users on Projects.`user_id` = Users.`id` where Users.`id` = :userid
        order by Projects.`posted_at`");
        $statement->bindValue(':userid', $id);
        $statement->execute();
        return $statement->fetchAll();
    }
    // Gets all data from post with project id
    public static function getPostById($id){
        $conn = DB::getConnection();
        $statement = $conn->prepare("select * from Projects where id = :id");
        $statement->bindValue("id", $id);
        $statement->execute();
        return $statement->fetch();
    }
    // Gets data from post creator with project id
    public static function getCreatorByPost($id){
        $conn = DB::getConnection();
        $statement = $conn->prepare("select Users.`firstname`, Users.`lastname`, Users.`profile_image`, Users.`id` from Projects INNER join Users on Projects.`user_id` = Users.`id` where Projects.`id` = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        return $statement->fetch();
    }
    // Check if visitor is creator of post
    public static function authPost($id){
        $conn = DB::getConnection();
        $statement = $conn->prepare("select title from post where id = :postId and where user_id = :id");
        $statement->bindValue(":postId", $id);
        $statement->execute();
        return $statement->fetch();
    }
    public static function updatePost($title, $tags, $id){
        //saving the post
        $conn = DB::getConnection();
        $statement = $conn->prepare("update Projects set title = :title where id = :id");
        $statement->bindValue(":title", $title);
        $statement->bindValue(":id", $id);
        $statement->execute();

        //Deleting old many to many tags
        $statement = $conn->prepare("delete from Project_Tags WHERE Project_Tags.project_id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();

        //Seperate tags into array
        $tags = explode(',', $tags);

        //saving tags
        $statement = $conn->prepare("insert into Tags(tag) values (:tag)");
        if ($tags != null) {
            foreach ($tags as $tag) {
                if (!self::findTag($tag)) {
                    $statement->bindValue(':tag', $tag);
                    $statement->execute();
                }
            }
        }
        //saving the many to many relationship between tags and posts
        foreach ($tags as $tag) {
            $statement = $conn->prepare("insert into Project_Tags(tag_id, project_id) values ((select id from Tags where tag = :tag), :project_id)");
            $statement->bindValue(':tag', $tag);
            $statement->bindValue(':project_id', $id);
            $statement->execute();
        }
    }

    public static function deletePostById($id)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("delete from Projects where id = :postId");
        $statement->bindValue(':postId', $id);
        $statement->execute();
    }

}
