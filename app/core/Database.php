<?php

namespace app\core;

/**
 * 
 */
class Database
{
	public static function query($query)
	{
		$mysqli = Database::link();

		$data = $mysqli->query($query);

		return (mysqli_insert_id($mysqli) || mysqli_info($mysqli)) ? mysqli_affected_rows($mysqli) : $data;
	}

	private function link()
	{
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

		if(!$mysqli = new \mysqli("localhost", "root", "*Saltillo6352"))
			throw new \Exception("Internal server error", 500);

		return $mysqli;
	}
}