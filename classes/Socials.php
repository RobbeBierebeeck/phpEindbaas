<?php
    include_once(__DIR__ . '/../bootstrap.php');

    class Socials
    {
        private $userId;
        private $socialLink;
        private $platform;

        /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $id
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

        /**
         * Get the value of socialLink
         */ 
        public function getSocialLink()
        {
                return $this->socialLink;
        }

        /**
         * Set the value of socialLink
         *
         * @return  self
         */ 
        public function setSocialLink($socialLink)
        {
                $this->socialLink = $socialLink;

                return $this;
        }

        /**
         * Get the value of platform
         */ 
        public function getPlatform()
        {
                return $this->platform;
        }

        /**
         * Set the value of platform
         *
         * @return  self
         */ 
        public function setPlatform($platform)
        {
                $this->platform = $platform;

                return $this;
        }

        public function save()
        {
            
           $conn = DB::getConnection();
            $statement = $conn->prepare("insert into Social_links (user_id, link, platform) values (:user_id, :link, :platform)");
            $statement->bindValue(':user_id', $this->userId);
            $statement->bindValue(':link', $this->socialLink);
            $statement->bindValue(':platform', $this->platform);
            $statement->execute();
        }

    
    }