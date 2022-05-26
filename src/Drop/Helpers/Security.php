<?php
    namespace Drop\Helpers;

    use Drop\Core\User;

    include_once (__DIR__.'/../../../vendor/autoload.php');
    abstract class Security {
        public static function onlyLoggedInUsers() {
            session_start();
            if(!isset($_SESSION['user'])){
                header("Location: login.php");
            }
        }

        public static function onlyAdminUsers($userId)
        {
            if (!User::isAdmin(User::getUserId($userId))) {
                header("Location: index.php");
            }
            
        }
    }
