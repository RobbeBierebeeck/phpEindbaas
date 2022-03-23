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
            throw new Exception("User does already exist");
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
        if ($password != $passwordConf) {
            throw new Exception("Passwords should be the same");
        } else {
            $this->password = $password;
            //throw new Exception("Passwords match");
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
        $options = [
            'cost' => 13
        ];
        $password = password_hash($this->password, PASSWORD_DEFAULT, $options);

        $conn = DB::getConnection();
        $statement = $conn->prepare("insert into User (firstname, lastname, email, password, created_at) values (:firstname, :lastname, :email, :password, NOW())");
        $statement->bindValue(':firstname', $this->firstName);
        $statement->bindValue(':lastname', $this->lastName);
        $statement->bindValue(':email', $this->email);
        $statement->bindValue(':password', $password);
        $statement->execute();
    }
}