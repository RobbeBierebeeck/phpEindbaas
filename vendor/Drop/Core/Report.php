<?php

namespace vendor\Drop\Core;

class Report
{
    public static function deleteReportedUsers($id)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("delete Reported_users from Users INNER JOIN Reported_users on Users.id = Reported_users.user_id WHERE Users.id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
    }
}