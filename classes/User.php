<?php
include_once(__DIR__ . '/DB.php');

class User
{
    private $email;
    private $password;
    private $firstName;
    private $lastName;
    private $profilePicture;


    public static function findByEmail($email)
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("select email from Users where email = :email");
        $statement->bindValue("email", $email);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC); //connectie default instellen

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
        } else throw new Exception("Please use your thomasmore account to register");
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

        if (self::checkPasswords($password, $passwordConf)) {
            $this->password = $password;
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
    public static
    function getProfilePicture()
    {
        $email = $_SESSION['user'];
        $conn = DB::getConnection();
        $statement = $conn->prepare("select profile_image from users where email = :email");
        $statement->bindValue(":email", $email);
        $statement->execute();
        $imageTable = $statement->fetch();
        $imagePath = $imageTable["profile_image"];
        return $imagePath;
    }

    /**
     * @param mixed $profilePicture
     */
    public
    function setProfilePicture($profilePicture)
    {
        try {
            $conn = DB::getConnection();
            //$statement = $conn->prepare("INSERT INTO user (profile_image) VALUES (:picture)");

            $targetDirectory = './upload/';
            $targetFile = $targetDirectory . basename($profilePicture['name']);

            if (empty($profilePicture['name'])) {
                //use placeholder as default if no local file is selected
                $targetFile = $targetDirectory . "avatar_template.png";
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        $this->profilePicture = $targetFile;
    }

    public
    function save()
    {


        $conn = DB::getConnection();
        $statement = $conn->prepare("insert into Users (firstname, lastname, email, password, created_at, profile_image) values (:firstname, :lastname, :email, :password, NOW(), :profilePic)");
        $statement->bindValue(':firstname', $this->firstName);
        $statement->bindValue(':lastname', $this->lastName);
        $statement->bindValue(':email', $this->email);
        $statement->bindValue(':password', SELF::hashPassword($this->password));
        $statement->bindValue(':profilePic', $this->profilePicture);
        $statement->execute();
    }

    public static function getUserId($email)
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("select id from Users where email = :email");
        $statement->bindValue("email", $email);
        $statement->execute();
        $id = $statement->fetch(PDO::FETCH_ASSOC);
        return $id['id'];
    }
    public static function setResetData($userId, $code)
    {
        $t = time();
        $conn = Db::getConnection();
        $statement = $conn->prepare("insert into Password_Reset_Temp(user_id, exp_date,code) values (:userId, :time , :key)");
        $statement->bindValue("userId", $userId);
        $statement->bindValue("key", $code);
        $statement->bindValue("time", $t);
        $statement->execute();
    }

    public static function checkPasswords($password, $passwordConf)
    {
        if ($password != $passwordConf) {
            throw new Exception("Passwords should be the same");
        } else if (strlen($password) < 6) {
            throw new Exception("Passwords is to short");
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
        $statement = $conn->prepare("update Users set password = :password where id = (select user_id from Password_Reset_Temp where code = :code and active = 1)");
        $statement->bindValue("code", $code);
        $statement->bindValue("password", $password);
        $statement->execute();
    }
    public static function deletePasswordReset($code)
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("update Password_Reset_Temp set active = 0 where code = :code ");
        $statement->bindValue("code", $code);
        $statement->execute();
    }

    public static function isExpired($code)
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("select exp_date from Password_Reset_Temp where code = :code and active = 1");
        $statement->bindValue("code", $code);
        $statement->execute();
        $expDate = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$expDate) {
            throw new Exception("The link is outdated");;
        } else {
            $t = time();
            $diff = $t - $expDate['exp_date'];
            if ($diff > 86400) {
                //throw new Exception("The link is outdated");
                self::deletePasswordReset($code);
            }
        }
    }

    public function canLogin()
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("select email, password from users where email = :email");
        $statement->bindValue("email", $this->email);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $hash = $user['password'];
            if (password_verify($this->password, $hash)) {
                return true;
            } else {
                return false;
            }
        } else {

            throw new Exception("username or password is incorrect");
        }
    }
}
