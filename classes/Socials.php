<?php
    include_once(__DIR__ . '/../bootstrap.php');

    class socials
    {
        private $id;
        private $socialLink;
        private $platform;

        /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
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
    }