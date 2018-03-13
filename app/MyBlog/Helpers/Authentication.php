<?php

namespace MyBlog\Helpers;

use \Firebase\JWT\JWT;

class Authentication
{
	
	public static function requireAuth()
	{
		//1.get the access_token from the request
		$access_token = null;
		if(isset(apache_request_headers()["Authorization"])){
			$access_token = substr(apache_request_headers()["Authorization"], 7);
		}
		//2. check if token exists if not protect te resurs
		if(!$access_token){
			$message = ["error" => "you don't send any access_token"];
			//http_response_code(403);
			header('Content-type: application/json');
			echo json_encode($message);
			exit;
		}
		
		//3. check if the token is valid if not valid protect the resurs
		try{
			$decoded = JWT::decode($access_token, getenv('SECRET_KEY'), array('HS256'));
			//return the user id of the current user
			return $decoded->sub;
		}catch(\Exception $e){
			$message = ["error" => "your access_token has expired, login again"];
			//http_response_code(403);
			header('Content-type: application/json');
			echo json_encode($message);
			exit;
		}

	}
	
}