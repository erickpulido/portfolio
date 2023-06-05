<?php

namespace app\controllers;

use app\core\View,
	app\models\Crud AS ModelCrud;
/**
 * 
 */
class Crud
{
	
	function __construct()
	{
		$this->_model = new ModelCrud();
	}

	/**
	 *
	 */
	public function index()
	{
		View::set('users', $this->_model->users());
		View::render("crud/index");
	}

	/**
	 *
	 */
	public function detail($action){
		$data = (object)$this->_model->userById(base64_decode($_POST['id']));

		View::set('action', $action);
		View::set('id', $data->{'id'});
		View::set('name', $data->{'name'});
		View::set('lastname', $data->{'lastname'});
		View::render("crud/detail");
	}

	/**
	 *
	 */
	public function log(){
		$data = json_decode(
			$this->_model->userById($id = $_POST['id'])['log'], true
		);

		View::set('id', $id);
		View::set('log', $data);
		View::render("crud/log");
	}

	/**
	 *
	 */
	public function cud($action, $isActive = 1)
	{
		$id = null;
		$message = "OK.";

		if($action === 'update' || $action === 'restore' || $action === 'delete')
			$log = json_decode(
				$this->_model->userById($id = $_POST['id'])['log'], true
			);

		$log[] = [
					'createDate' => $action === 'create' ? date("Y-m-d H:i:s") : reset($log)['createDate'],
					'updateDate' => date("Y-m-d H:i:s"),
					'action' => $action,
					'name' => $name = $action === 'restore' ? $log[$_POST['key']]['name'] : $_POST['name'],
					'lastname' => $lastname = $action === 'restore' ? $log[$_POST['key']]['lastname'] : $_POST['lastname']
				];

		$result = call_user_func([$this->_model, $action === 'restore' || $action === 'delete' ? 'update' : $action],
			$id,
			$name,
			$lastname,
			addslashes(json_encode($log)),
			$isActive
		);

		if(!$result)
			$message = "Algo salió mal.";

		$this->response($message, $view = "crud/response");
	}

	/**
	 *
	 */
	private function response($message, $view)
	{
		View::set('message', $message);
		View::render($view);
	}

	/*
	 *
	 */
	public function encrypt($string = 'Hola', $action = 'decrypt'){

		$output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'hola123';
        $secret_iv = '123hola';
        // hash
        $key = hash('sha256', $secret_key);    
        // iv - encrypt method AES-256-CBC expects 16 bytes 
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if( $action == 'decrypt' ) {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
	}
}