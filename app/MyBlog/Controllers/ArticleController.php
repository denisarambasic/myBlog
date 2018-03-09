<?php

namespace MyBlog\Controllers;

use MyBlog\Models\Article;
use MyBlog\Helpers\Authentication;

class ArticleController
{
	public function index()
	{
		//Authentication::requireAuth();
		
		$article = new Article();
		$articles = $article->getAll();
		
		$response = ['articles' => $articles];
		
		http_response_code(200);
		header('Content-type: application/json');
		echo json_encode($response);
		
	}
}