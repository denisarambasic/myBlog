<?php

namespace MyBlog\Controllers;

use MyBlog\Models\Article;

class ArticleController
{
	public function index()
	{
		
		$article = new Article();
		$articles = $article->getAll();
		
		$response = ['articles' => $articles];
		
		http_response_code(200);
		header('Content-type: application/json');
		echo json_encode($response);
		
	}
}