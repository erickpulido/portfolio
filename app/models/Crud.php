<?php

namespace app\models;

use app\core\Database;

/**
 * 
 */
class Crud
{
	
	function __construct()
	{
		
	}

	public function users(){
		$query = "
			SELECT id,name,lastname FROM `s2next`.`users`;
		";
		return Database::query($query)->fetch_all(MYSQLI_ASSOC);
	}

	public function userById($id){
		$query = "
			SELECT id,name,lastname,log FROM `s2next`.`users` WHERE `id` = '$id';
		";
		return Database::query($query)->fetch_assoc();
	}

	public function create($id, $name, $lastname, $log){
		$query = "
			INSERT INTO `s2next`.`users` (name, lastname, log) VALUES ('$name','$lastname','$log');
		";
		return Database::query($query);
	}

	public function update($id, $name, $lastname, $log, $isActive = 1){
		$query = "
			UPDATE `s2next`.`users`
			SET `name` = '$name'
				,`lastname` = '$lastname'
				,`log` = '$log'
				,`isActive` = $isActive
			WHERE `id` = '$id';
		";
		return Database::query($query);
	}
}