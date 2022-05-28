<?php

namespace Drop\Core;

include_once(__DIR__ . '/../../../vendor/autoload.php');
use Drop\Core\DB;
use PDO;
use Exception;

class Invite
{
    private $code;

    /**
     * Get the value of code
     */ 
    public function getCode()
    {
        return $this->code;
    }

    
    public function setCode($code){
        $this->code = Invite::hashCode($code);

        return $this;
    }

    public static function hashCode($code){
        $options = [
            'cost' => 13
        ];
        return password_hash($code, PASSWORD_DEFAULT, $options);
    }

    public function generateInvite(){
        $url = "inviteregister.php?code=" . $this->code;
        return $url;
    }

    public function saveCode(){
        $conn = DB::getConnection();
        $statement = $conn->prepare("insert into invite_links (code) values (:code)");
        $statement->bindValue(':code', $this->code);
        $statement->execute();
    }

    public static function checkIfCodeAvailable($code){
        $hashCode = Invite::hashCode($code); 
        $conn = DB::getConnection();
        $statement = $conn->prepare("select * from invite_links where code = :code");
        $statement->bindValue(':code', $hashCode);
        $statement->execute();
        return $statement->fetch();
    }

    public static function checkLinkCode($code){
        $conn = DB::getConnection();
        $statement = $conn->prepare("select * from invite_links where code = :code");
        $statement->bindValue(':code', $code);
        $statement->execute();
        return $statement->fetch();
    }
}
