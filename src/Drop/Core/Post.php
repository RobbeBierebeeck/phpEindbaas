<?php
namespace Drop\Core;
include_once(__DIR__ .'/../../../config/configCloud.php');
use Cloudinary\Api\Upload\UploadApi;
use Drop\Core\DB;
use Exception;
use PDO;

use PHPColorExtractor\PHPColorExtractor;
include_once (__DIR__.'/../../../vendor/autoload.php');


class Post
{
    private $id;
    private $tags;
    private $title;
    private $description;
    private $image;
    private $userId;
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
            if (filesize($image['tmp_name']) < 5000000) {
                $image = (new UploadApi())->upload($image['tmp_name'], ["folder" => "posts", "format" => "webp", "quality" => "auto", "aspect_ratio" => "4:3", "width" => "800", "crop" => "fill", "gravity" => "face", "flags" => "progressive"]);
                //extracting the colors from the image



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
        $statement = $conn->prepare("INSERT INTO Projects (title, image, description, posted_at, user_id, publicId) VALUES (:title, :image, :description, NOW(), :user_id, :publicId)");
        $statement->bindParam(':title', $this->title);
        $statement->bindParam(':image', $this->image);
        $statement->bindParam(':description', $this->description);
        $statement->bindParam(':user_id', $this->userId);
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

        //colors
        /*var_dump(self::extractColors($this->image));
        die();/**/

    }

    /**
     * function to find views that are private
     */

    public static function findPrivateViews($data){

        $posts = array();
        foreach ($data as $key => $post){
            if ($post['publicViews'] == 0) {
                unset($post['views']);
            }
            $posts[] = $post;
        }

        return $posts;

    }

    public static function getAll($start, $limit)

    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("select Projects.`id`, Projects.`title`, Projects.`image`, Projects.`description`, Projects.`posted_at`, Users.`id` as user_id, Users.`firstname`, Users.`lastname`, Users.`profile_image`,
Users.`publicViews`, (select count(user_id) from Likes where project_id = Projects.`id` and status = 1 ) as likes,  (select count(ip) from Views where `project_id` = Projects.id) as views from Projects
INNER join Users on Projects.`user_id` = Users.`id`
order by Projects.`posted_at` desc limit :start, :limit");
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->bindValue(':start', $start, PDO::PARAM_INT);
        $statement->execute();

        return Self::findPrivateViews($statement->fetchAll());

    }

    public static function getAllOldest($start, $limit)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("select Users.`publicViews`, Projects.`id`, Projects.`title`, Projects.`image`, Projects.`description`, Projects.`posted_at`, Users.`id` as user_id, Users.`firstname`, Users.`lastname`, Users.`profile_image`
, (select count(user_id) from Likes where project_id = Projects.`id` and status = 1 ) as likes,  (select count(ip) from Views where `project_id` = Projects.id) as views from Projects
INNER join Users on Projects.`user_id` = Users.`id`
order by Projects.`posted_at` asc limit :start, :limit");
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->bindValue(':start', $start, PDO::PARAM_INT);
        $statement->execute();
        return Self::findPrivateViews($statement->fetchAll());

    }

    public static function getAllFollowing($start, $limit, $userId)
    {
      $conn = DB::getConnection();
        $statement = $conn->prepare("select Users.`publicViews`, Projects.`id`, Projects.`title`, Projects.`image`, Projects.`description`, Projects.`posted_at`, Users.`id` as user_id, Users.`firstname`, Users.`lastname`, Users.`profile_image`
, (select count(user_id) from Likes where project_id = Projects.`id` and status = 1 ) as likes,  (select count(ip) from Views where `project_id` = Projects.id) as views from Projects

INNER join Users on Projects.`user_id` = Users.`id`
Inner join Followers on Projects.`user_id` = Followers.`following_id`
where Followers.`follower_id` = :user_id
order by Projects.`posted_at` desc limit :start, :limit");
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->bindValue(':start', $start, PDO::PARAM_INT);
        $statement->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $statement->execute();
        return Self::findPrivateViews($statement->fetchAll());
    }

    public static function search($search, $start, $limit)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("select Users.`publicViews`,  Projects.`id`, Projects.`title`, Projects.`image`, Projects.`description`, Projects.`posted_at`, Users.`firstname`, Users.`lastname`, Users.`profile_image`, Users.`id` as user_id
,(select count(user_id) from Likes where project_id = Projects.`id` and status = 1 ) as likes, (select count(ip) from Views where `project_id` = Projects.id) as views from Projects 
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
        return array_unique(Self::findPrivateViews($statement->fetchAll()), SORT_REGULAR);

    }

    public static function getUserProjectsById($id)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("select Users.`publicViews`, Projects.`id`, Projects.`title`, Projects.`image`, Projects.`description`, Projects.`posted_at`, Users.`firstname`, Users.`lastname`, Users.`profile_image`
        from Projects INNER join Users on Projects.`user_id` = Users.`id` where Users.`id` = :userid
        order by Projects.`posted_at`");
        $statement->bindValue(':userid', $id);
        $statement->execute();
        return Self::findPrivateViews($statement->fetchAll());
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
        $statement->bindValue(":title",  $title);
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


    public static function deletePostImage($id)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare('SELECT publicId FROM Projects WHERE id = :id');
        $statement->bindValue(':id', $id);
        $statement->execute();
        $publicIds = $statement->fetch();
            (new UploadApi())->destroy($publicIds['publicId']);
    }

    public static function updateShowcase($postId, $showcase)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("update Projects set showcase = :showcase where id = :postId");
        $statement->bindValue(":showcase", $showcase);
        $statement->bindValue(":postId", $postId);
        $statement->execute();
    }

    public static function isShowcase($postId)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("SELECT showcase FROM Projects WHERE id = :postId");
        $statement->bindValue(":postId", $postId, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch()['showcase'];
    }

    public static function getShowcase($userId)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("SELECT * FROM Projects WHERE showcase = 1 AND user_id = :userId ");
        $statement->bindValue(":userId", $userId,);
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function getApi()
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("select id, title, image, posted_at from Projects");
        $statement->execute();
        return $statement->fetchAll();
    }



    /**
     * Colors
     */

    public static function extractColors($image){

        $extractor = new PHPColorExtractor();
        $extractor->setImage($image)->setTotalColors(5)->setGranularity(10);
        $colors = $extractor->extractPalette();

       return $colors;

    }

    //converting colors to hex

    public static function convertIntToHex($colors)
    {
        $hexColors = [];
        foreach ($colors as $color) {
            $hexColors[] = "#".$color;
        }
       return $hexColors;
    }

    //saving the colors to the database

    public static function saveColors($colors, $postId)
    {
       $conn = DB::getConnection();
        $statement = $conn->prepare("insert into colors (hex) values (:hex) on duplicate key update hex = :hex");
        foreach ($colors as $color) {

            if (!self::colorAlreadyExists($color)) {
                $statement->bindValue(":hex", $color);
                $statement->execute();


            }
            self::saveManyToMany($color, $postId);
       }

    }

    //saving many to many relationship
    private static function saveManyToMany($color, $postId)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("insert into project_colors (color_id, project_id) values ((select colors.`id` from colors where colors.`hex` = :hex), :postId) ");
        $statement->bindValue(":hex",$color);
        $statement->bindValue(":postId", $postId);
        $statement->execute();

    }

    //checking if color already exists in the database to avoid duplicates

    private static function colorAlreadyExists($color)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("select hex from colors where hex = :hex");
        $statement->bindValue(":hex", $color);
        $statement->execute();
        return $statement->fetch()['hex'];
    }

    public static function getColorsForPost($postId)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("select colors.`hex` from colors inner join project_colors on colors.`id` = project_colors.`color_id`where project_colors.`project_id` = :postId");
        $statement->bindValue(":postId", $postId);
        $statement->execute();
        return $statement->fetchAll();
    }

}
