<?php

namespace app\core;

/**
 * 
 */
class View
{
	protected static $data = [];

	public static function render($filename)
	{
		$file = PROJECT_PATH."/app/views/$filename.php";

		if (!is_file($file))
			throw new \Exception("View $filename not found", 404);

		ob_start();

		extract(self::$data);

		include $file;

		echo ob_get_clean();
	}

	public static function set($key, $value)
	{
		self::$data[$key] = $value;
	}
}