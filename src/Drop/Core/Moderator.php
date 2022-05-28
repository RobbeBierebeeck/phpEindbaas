<?php

namespace Drop\Core;

use Drop\Core\DB;

include_once(__DIR__ . '/../../../vendor/autoload.php');

abstract class Moderator
{
    public static function getAllReportedUsers()
    {
        $conn = DB::getConnection();
        $stmt = $conn->prepare("select distinct Users.`id`, Users.`firstName`, Users.`lastName`,Users.`email`, (select count(id) from reported_users where user_id = Users.`id`) as timesReported  from reported_users 
Inner join Users on reported_users.`user_id` = Users.`id` where Users.`banned` = 0");
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
}