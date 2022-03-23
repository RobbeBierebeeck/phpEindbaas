<?php
include_once(__DIR__ . '/DB.php');

class User
{
    private $email;
    private $password;
    private $firstName;
    private $lastName;
    private $profilePicture;


    public static function existUser($email)
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("select email from User where email = :email");
        $statement->bindValue("email", $email);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
       if ($user) {
           return false;
        } else return true;
    }

    /**
     * @return mixed
     */
    public
    function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */

    public function setEmail($email)
    {

            //first part -> allowed chars , student <- possible to have makes a group , has to have thomasmore.be
            $regex = '/[a-zA-Z0-9_.+-]+@(student\.)?thomasmore\.be/';

            if (preg_match($regex, $email)) {
                $this->email = $email;
            }else throw new Exception("Please use your thomasmore account to register");


    }

    /**
     * @return mixed
     */
    public
    function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public
    function setPassword($password, $passwordConf)
    {

        if(self::checkPasswords($password, $passwordConf)){
            $this->password = self::hashPassword($password);
        }


    }

    /**
     * @return mixed
     */
    public
    function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public
    function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public
    function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public
    function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public
    function getProfilePicture()
    {
        return $this->profilePicture;
    }

    /**
     * @param mixed $profilePicture
     */
    public
    function setProfilePicture($profilePicture)
    {
        $this->profilePicture = $profilePicture;
    }

    public
    function save()
    {


        $conn = DB::getConnection();
        $statement = $conn->prepare("insert into User (firstname, lastname, email, password, created_at) values (:firstname, :lastname, :email, :password, NOW())");
        $statement->bindValue(':firstname', $this->firstName);
        $statement->bindValue(':lastname', $this->lastName);
        $statement->bindValue(':email', $this->email);
        $statement->bindValue(':password', $this->password);
        $statement->execute();
    }

    public static function getUserId($email)
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("select id from User where email = :email");
        $statement->bindValue("email", $email);
        $statement->execute();
        $id= $statement->fetch(PDO::FETCH_ASSOC);
        return $id['id'];

    }
    public static function setResetData($userId, $code)
    {
        $t = time();
        $conn = Db::getConnection();
        $statement = $conn->prepare("insert into Password_Reset_Temp(User_id, exp_date,code) values (:userId, :time , :key)");
        $statement->bindValue("userId", $userId);
        $statement->bindValue("key",$code);
        $statement->bindValue("time",$t);
        $statement->execute();
    }

    public static function checkPasswords($password, $passwordConf)
    {
        if ($password != $passwordConf) {
            throw new Exception("Passwords should be the same");
        } else return true;
    }
    public static function hashPassword($password)
    {
        $options = [
            'cost' => 13
        ];
        return password_hash($password, PASSWORD_DEFAULT, $options);
    }
    public static function updatePassword($code, $password)
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("update User set password = :password where id = (select User_id from Password_Reset_Temp where code = :code)");
        $statement->bindValue("code", $code);
        $statement->bindValue("password",$password);
        $statement->execute();
    }
}