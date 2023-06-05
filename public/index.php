<?php

ini_set('display_errors', E_ALL);

const DS = DIRECTORY_SEPARATOR;

define('PROJECT_PATH', str_replace(DS, '/', dirname(__DIR__)));

spl_autoload_register(function($class){

	include $file = str_replace(DS, '/', PROJECT_PATH."/$class.php");

});

new app\core\Requester();