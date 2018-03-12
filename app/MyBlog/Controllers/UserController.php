<?php

namespace MyBlog\Controllers;

use MyBlog\Helpers\Authentication;
use MyBlog\Models\Article;

class UserController
{
	public function index(){
		//1.get the user_id of the current user
		$user_id = Authentication::requireAuth();
		//2. Load only the articles of the current user;
		$article = new Article();
		$articles = $article->getByUserId($user_id);
		
		http_response_code(200);
		header('Access-Control-Allow-Origin: *');
		header('Content-type: application/json');
		echo json_encode($articles);
		
	}
}