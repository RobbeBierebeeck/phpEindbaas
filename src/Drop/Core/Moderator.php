<?php

namespace Drop\Core;

use Drop\Core\DB;
use Drop\Core\Post;

include_once(__DIR__ . '/../../../vendor/autoload.php');

abstract class Moderator
{
    public static function getAllReportedUsers()
    {
        $conn = DB::getConnection();
        $stmt = $conn->prepare("select distinct users.`id`, users.`firstName`, users.`lastName`,users.`email`, (select count(id) from reported_users where reported_id = users.`id`) as timesReported  from reported_users 
Inner join users on reported_users.`reported_id` = users.`id` where users.`banned` = 0");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function blockUser($userId)
    {
        $conn = DB::getConnection();
        $stmt = $conn->prepare("update users set banned = 1 where id = :userId");
        $stmt->bindValue(':userId', $userId);
        $stmt->execute();
    }

    public static function getAllBlockedUsers()
    {
        $conn = DB::getConnection();
        $stmt = $conn->prepare("select id, firstName, lastName, email from users where banned = 1");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function unBlockUser($userId)
    {
        $conn = DB::getConnection();
        $stmt = $conn->prepare("update users set banned = 0 where id = :userId");
        $stmt->bindValue(':userId', $userId);
        $stmt->execute();
    }

    public static function banUser($id)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("delete from users WHERE id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
    }

    public static function removeReport($id){
        $conn = DB::getConnection();
        $stmt = $conn->prepare("delete from reported_users WHERE reported_id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    public static function getAllReportedPosts()
    {
        $conn = DB::getConnection();
        $stmt = $conn->prepare("select projects.`id`, projects.`title`, projects.`publicId` ,users.`firstname`, (select count(id) from reported_projects where project_id = projects.`id`) as count from projects inner join reported_projects on projects.`id` = reported_projects.`project_id`
inner join users on projects.`user_id` = users.`id`");
        $stmt->execute();
        return $stmt->fetchAll();
    }

}