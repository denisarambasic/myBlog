<?php

namespace MyBlog\Controllers;

class LoginController
{
	
	public function index()
	{
		$message = ["message" => "To login and get your access_token send a post requset with your email and password"];
		http_response_code(200);
		header('Content-type: application/json');
		echo json_encode($message);
	}
	
}