<?php

namespace MyBlog\Controllers;

use MyBlog\Helpers\Authentication;
use MyBlog\Models\Article;

class UserController
{
	public function index(){
		http_response_code(200);
		header('Access-Control-Allow-Origin: *');
		header('Content-type: application/json');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
		//1.get the user_id of the current user
		$user_id = Authentication::requireAuth();
		//2. Load only the articles of the current user;
		$article = new Article();
		$articles = $article->getByUserId($user_id);

		echo json_encode($articles);
		
	}
	
	//get the user id of the current user if the access token is valid
	public function checkUser()
	{
		/*header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
		header('Access-Control-Expose-Headers: Authorization');*/
		http_response_code(200);
		header('Access-Control-Allow-Origin: *');
		header('Content-type: application/json');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
		
		$user_id = Authentication::requireAuth();
		echo json_encode(['user_id'=>$user_id]);
	}
	
	public function createArticleInfo()
	{		
		http_response_code(200);
		header('Access-Control-Allow-Origin: *');
		header('Content-type: application/json');
		$message = ["message" => "To create a new article you need to be logged in and send a post req with params ['title', 'content']"];
		echo json_encode($message);
	}
	
}