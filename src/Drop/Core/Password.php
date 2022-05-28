<?php

namespace Drop\Core;
use PDO;

include_once('vendor/autoload.php');
abstract class Password
{
    public static function isExpired($code)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("select exp_date from password_reset_temp where code = :code and active = 1");
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
        $statement = $conn->prepare("update users set password = :password where id = (select user_id from password_reset_temp where code = :code and active = 1)");
        $statement->bindValue("code", $code);
        $statement->bindValue("password", $password);
        $statement->execute();
    }

    public static function deletePasswordReset($code)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("update password_reset_temp set active = 0 where code = :code ");
        $statement->bindValue("code", $code);
        $statement->execute();
    }

    public static function setResetData($userId, $code)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("insert into password_reset_temp(user_id, exp_date,code) values (:userId, now() , :key)");
        $statement->bindValue("userId", $userId);
        $statement->bindValue("key", $code);
        $statement->execute();
    }

    public static function deletePasswordTemp($id)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("delete password_reset_temp from users INNER JOIN password_reset_temp on users.id = password_reset_temp.user_id WHERE users.id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
    }

}