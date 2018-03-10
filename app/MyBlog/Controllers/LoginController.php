<?php

namespace MyBlog\Controllers;

use \Firebase\JWT\JWT;

use MyBlog\Models\User;

class LoginController
{
	
	public function index()
	{
		header('Access-Control-Allow-Origin: *');
		$message = ["message" => "To login and get your access_token send a post requset with your email and password"];
		http_response_code(200);
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
		
		//1. Get user by email if not exists throw error
		$user = new User();
		$user = $user->getUserByEmail($email);
		
		if(!$user){
			$error = ["error" => "Wrong credentials"];
			//http_response_code(400);
			header('Content-type: application/json');
			echo json_encode($error);
			exit;
		}
		//2. check password if wrong throw error
		if(!password_verify($password, $user['password'])){
			$error = ["error" => "Wrong credentials"];
			//http_response_code(400);
			header('Content-type: application/json');
			echo json_encode($error);
			exit;
		}
		//3. create jsonWebToken
		$expTime = time() + 3600; //The access_token is valid 1 hour
		$jwt = JWT::encode([
			"iss" => "192.168.33.10",
			"sub" => $user['email'],
			"exp" => $expTime,
			"iat" => 1356999524,
			"nbf" => 1357000000
		], getenv('SECRET_KEY'));
		
		//4. send back the access_token(jwt)
		$message = ['access_token' => $jwt];
		http_response_code(200);
		header('Content-type: application/json');
		echo json_encode($message);
	}
	
}