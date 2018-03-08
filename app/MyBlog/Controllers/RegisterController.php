<?php

namespace MyBlog\Controllers;

class RegisterController
{
	
	public function index()
	{
		$message = ["message" => "To register yourself send a POST request with this values ['email','password', 'password_repeat']"];
		http_response_code(200);
		header('Content-type: application/json');
		echo json_encode($message);
	}
	
}