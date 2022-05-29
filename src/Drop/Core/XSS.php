<?php

namespace Drop\Core;

abstract class XSS
{
    public static function specialChars($string)
    {
        if(!empty($string)){
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
        }
    }
}