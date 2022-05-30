<?php

namespace Drop\Core;
use Drop\Core\DB;

include_once (__DIR__.'/../../../vendor/autoload.php');

abstract class Pagination
{
    //getting the count of posts

    public static function getCountOfPosts()
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("select count(projects.`id`) as count from projects ");
        $statement->execute();
        return $statement->fetch()['count'];

    }

    public static function getCountbySearch($search)    //getting the count of posts by search
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("select count(projects.id) as count from projects 
        INNER join users on projects.`user_id` = users.`id`
        INNER join project_tags on projects.`id` = project_tags.`project_id`
        INNER join tags on project_tags.`tag_id` = tags.`id` where tags.`tag`
        like :search or projects.`title`like :search or users.`firstname` like :search or users.`lastname` like :search
        order by projects.`posted_at`");

        $search = "%" . $search . "%";
        $statement->bindValue(':search', $search);
        $statement->execute();
        return $statement->fetch()['count'];

    }

    public static function getCountByColors($hex)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("select count(projects.`id`) as count from projects
INNER join users on projects.`user_id` = users.`id`
Inner join project_colors on projects.`id`= project_colors.`project_id`
inner join colors on project_colors.`color_id` = colors.`id`
where colors.`hex` = :hex");
        $statement->bindValue(':hex', $hex);
        $statement->execute();
        return $statement->fetch()['count'];

    }
}