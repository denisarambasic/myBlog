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
		
		http_response_code(200);
		header('Content-type: application/json');
		echo json_encode($articles);
		
	}
	
	public function getById($data)
	{
		$id = $data[0];
		$article = new Article();
		$article = $article->getById($id);
		
		http_response_code(200);
		header('Content-type: application/json');
		echo json_encode($article);
	}
}