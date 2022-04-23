<?php

class Like
{
    public static function deleteLikes($id)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("delete Likes from Users INNER JOIN Likes on Users.id = Likes.user_id WHERE Users.id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
    }
}