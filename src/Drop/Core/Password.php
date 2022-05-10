<?php

namespace Drop\Core;

include_once('vendor/autoload.php');
abstract class Password
{
    public static function isExpired($code)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("select exp_date from Password_Reset_Temp where code = :code and active = 1");
        $statement->bindValue("code", $code);
        $statement->execute();
        $expDate = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$expDate) {
            header("Location: 404.html");
        } else {
            $t = time();
            $diff = $t - strtotime($expDate['exp_date']);
            if ($diff > 86400) {
                //throw new Exception("The link s outdated");
                self::deletePasswordReset($code);
            }
        }
    }

    public static function updatePassword($code, $password)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("update Users set password = :password where id = (select user_id from Password_Reset_Temp where code = :code and active = 1)");
        $statement->bindValue("code", $code);
        $statement->bindValue("password", $password);
        $statement->execute();
    }

    public static function deletePasswordReset($code)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("update Password_Reset_Temp set active = 0 where code = :code ");
        $statement->bindValue("code", $code);
        $statement->execute();
    }

    public static function setResetData($userId, $code)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("insert into Password_Reset_Temp(user_id, exp_date,code) values (:userId, now() , :key)");
        $statement->bindValue("userId", $userId);
        $statement->bindValue("key", $code);
        $statement->execute();
    }

    public static function deletePasswordTemp($id)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("delete Password_Reset_Temp from Users INNER JOIN Password_Reset_Temp on Users.id = Password_Reset_Temp.user_id WHERE Users.id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
    }

}