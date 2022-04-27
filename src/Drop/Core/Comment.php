<?php

namespace Drop\Core;

class Comment
{
    public static function deleteComments($id)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("delete Comments from Users INNER JOIN Comments on Users.id = Comments.user_id WHERE Users.id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
    }
}