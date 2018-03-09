<?php

namespace MyBlog\Controllers;

use MyBlog\Models\Article;

class HomepageController
{
	public function index()
	{
		
		$article = new Article();
		$articles = $article->getLast3();
		
		//$response = ['articles' => $articles];
		
		http_response_code(200);
		header('Access-Control-Allow-Origin: *');
		header('Content-type: application/json');
		echo json_encode($articles);
		
	}
}