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
        $stmt = $conn->prepare("select distinct Users.`id`, Users.`firstName`, Users.`lastName`,Users.`email`, (select count(id) from reported_users where reported_id = Users.`id`) as timesReported  from reported_users 
Inner join Users on reported_users.`reported_id` = Users.`id` where Users.`banned` = 0");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function blockUser($userId)
    {
        $conn = DB::getConnection();
        $stmt = $conn->prepare("update Users set banned = 1 where id = :userId");
        $stmt->bindValue(':userId', $userId);
        $stmt->execute();
    }

    public static function getAllBlockedUsers()
    {
        $conn = DB::getConnection();
        $stmt = $conn->prepare("select id, firstName, lastName, email from Users where banned = 1");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function unBlockUser($userId)
    {
        $conn = DB::getConnection();
        $stmt = $conn->prepare("update Users set banned = 0 where id = :userId");
        $stmt->bindValue(':userId', $userId);
        $stmt->execute();
    }

    public static function banUser($id)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("delete from Users WHERE id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
    }

    public static function removeReport($id){
        $conn = DB::getConnection();
        $stmt = $conn->prepare("delete from reported_users WHERE reported_id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }
}