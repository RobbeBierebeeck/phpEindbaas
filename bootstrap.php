<?php

/*
 * This function loads all our classes
 * automagically when needed */

spl_autoload_register(function ($class){
    include_once (__DIR__."/classes/".$class.".php");
});
