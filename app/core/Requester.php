<?php

namespace app\core;

/**
 * 
 */
class Requester
{
	const CONTROLLER_NAMESPACE = 'app\controllers\\';
	
	function __construct()
	{
		try{
			$url = $this->parseUrl();

			$controller = $url[0];
			$method = $url[1];
			$args = array_slice($url, 2);

			$file = PROJECT_PATH."/app/controllers/$controller.php";

			if (!is_file($file))
				throw new \Exception("File $controller not found", 404);

			$class = self::CONTROLLER_NAMESPACE."$controller";

			if (!class_exists($class))
				throw new \Exception("Class $class not found", 404);

			if (!method_exists($instance = new $class, $method))
				throw new \Exception("Method $method not found", 404);

			$this->render($instance, $method, $args);
		}
		catch(\Exception $e){
			http_response_code($e->getCode());
			echo json_encode(
				$response = [
					'message' => $e->getMessage(),
					'code' => $e->getCode()
				],
				JSON_PRETTY_PRINT
			);
		}		
	}

	private function render($instance, $method, $args)
	{
		call_user_func_array([$instance, $method], $args);
	}

	private function parseurl()
	{
		return explode('/', parse_url($_GET['url'], PHP_URL_PATH ));
	}
}