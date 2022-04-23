<?php
include_once(__DIR__ . '/../bootstrap.php');

class User
{
    private $email;
    private $password;
    private $firstName;
    private $lastName;
    private $profilePicture;
    private $bio;
    private $secondEmail;


    public static function findByEmail($email)
    {
        $conn = DB::getConnection();
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
    function getProfilePicture($email)
    {
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
            $targetDirectory = './upload/';
            $targetFile = $targetDirectory . basename($profilePicture['name']);
            $tempFile = $profilePicture['tmp_name'];

            if (empty($profilePicture['name'])) {
                //use placeholder as default if no local file is selected
                $targetFile = $targetDirectory . "avatar_template.png";
            }

            move_uploaded_file($tempFile, $targetFile);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        $this->profilePicture = $targetFile;
    }

    public static function updatePicture($profilePicture, $user)
    {
        try {
            //find image to delete in upload folder
            $oldImage = User::getProfilePicture($_SESSION['user']);

            //get new image to upload
            $targetDirectory = './upload/';
            $targetFile = $targetDirectory . basename($profilePicture['name']);
            $tempFile = $profilePicture['tmp_name'];


            if ($oldImage != $targetFile) {
                if ($oldImage != "./upload/avatar_template.png") {
                    //remove image in filesystem if not equal to default avatar
                    unlink($oldImage);
                }

                //move new image to server
                move_uploaded_file($tempFile, $targetFile);

                //update image path in database
                $conn = DB::getConnection();
                $statement = $conn->prepare("update users set profile_image = :profilePic where id = :id");
                $statement->bindValue(':profilePic', $targetFile);
                $statement->bindValue(':id', $user);
                $statement->execute();
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public static function deletePicture($user)
    {
        try {
            //find image to delete in upload folder
            $oldImage = User::getProfilePicture($_SESSION['user']);

            //targetFile is set to default avatar
            $targetDirectory = './upload/';
            $targetFile = $targetDirectory . "avatar_template.png";

            //remove old picture in filesystem
            unlink($oldImage);

            //update image path in database
            $conn = DB::getConnection();
            $statement = $conn->prepare("update users set profile_image = :profilePic where id = :id");
            $statement->bindValue(':profilePic', $targetFile);
            $statement->bindValue(':id', $user);
            $statement->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
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
        $conn = DB::getConnection();
        $statement = $conn->prepare("select id from Users where email = :email");
        $statement->bindValue("email", $email);
        $statement->execute();
        $id = $statement->fetch(PDO::FETCH_ASSOC);
        return $id['id'];
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

    public static function editPassword($id, $oldpw, $newpw)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("select password from users where id = :id");
        $statement->bindValue("id", $id);
        $statement->execute();
        $checkpassword = $statement->fetch(PDO::FETCH_ASSOC);

        if ($checkpassword) {
            $hash = $checkpassword['password'];
            if (password_verify($oldpw, $hash)) {
                $statement = $conn->prepare("update users set password = :password where id = :id");
                $statement->bindValue("password", self::hashPassword($newpw));
                $statement->bindValue("id", $id);
                $statement->execute();
                $message = true;
            } else {
                $message = false;
            }
        }
        return $message;
    }

    /** Delete user functions */
    public static function deleteFollowers($id)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("delete Followers from Users INNER JOIN Followers on Users.id = Followers.following_id OR Users.id = Followers.follower_id WHERE Users.id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
    }
    public static function deleteUser($id)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("delete Users from Users WHERE Users.id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
    }


    public static function getById($id)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("select firstname, lastname, email, bio, profile_image from Users where id = :id");
        $statement->bindValue("id", $id);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    /**
     * Get the value of bio
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set the value of bio
     *
     * @return  self
     */
    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }

    public function linkBio($id)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("update Users set bio = :bio where id = :id");
        $statement->bindValue(':bio', $this->bio);
        $statement->bindValue(':id', $id);
        $statement->execute();
    }

    /**
     * Get the value of secondEmail
     */
    public function getSecondEmail()
    {
        return $this->secondEmail;
    }

    /**
     * Set the value of secondEmail
     *
     * @return  self
     */
    public function setSecondEmail($secondEmail)
    {
        $this->secondEmail = $secondEmail;

        return $this;
    }

    public function linkSecondEmail($id)
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare("update Users set second_email = :secondemail where id = :id");
        $statement->bindValue(':secondemail', $this->secondEmail);
        $statement->bindValue(':id', $id);
        $statement->execute();
    }
}
