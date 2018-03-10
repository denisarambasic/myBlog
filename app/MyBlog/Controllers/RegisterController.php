<?php

namespace MyBlog\Controllers;

use MyBlog\Models\User;

class RegisterController
{
	
	public function index()
	{
		header('Access-Control-Allow-Origin: *');
		$message = ["message" => "To register yourself send a POST request with this values ['email','password', 'password_repeat']"];
		http_response_code(200);
		header('Access-Control-Allow-Origin: *');
		header('Content-type: application/json');
		echo json_encode($message);
	}
	
	public function formData()
	{
		header('Access-Control-Allow-Origin: *');
		
		$data = file_get_contents('php://input');
		$data = json_decode($data);

		//filter input 
		$email = filter_var($data->email, FILTER_SANITIZE_EMAIL);
		$password = filter_var($data->password, FILTER_SANITIZE_STRING);
		$password_repeat = filter_var($data->password_repeat, FILTER_SANITIZE_STRING);
		
		//1.throw error if password dont match password repeat
		if($password != $password_repeat){
			$error = ["error" => "password is not equal password_repeat"];
			//http_response_code(400);
			header('Content-type: application/json');
			echo json_encode($error);
			exit;
		}

		//2.Check if the user with this email allready exists:
		$user = new User();
		
		if($user->getUserByEmail($email)){
			$error = ["error" => "a user with this email allready exists"];
			//http_response_code(400);
			header('Content-type: application/json');
			echo json_encode($error);
			exit;
		}
		
		//3.create password hash
		$password_hash = password_hash($password, PASSWORD_DEFAULT);
		
		//4.save the new user in the db
		$user->registerUser($email, $password_hash);
		
		$message = ["message" => "Registration success!"];
		http_response_code(201);
		header('Content-type: application/json');
		echo json_encode($message);
		
	}
	
}