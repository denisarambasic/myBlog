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
		header('Access-Control-Allow-Origin: *');
		header('Content-type: application/json');
		echo json_encode($articles);
		
	}
	
	public function getById($data)
	{
		$id = $data[0];
		$article = new Article();
		$article = $article->getById($id);
		
		http_response_code(200);
		header('Access-Control-Allow-Origin: *');
		header('Content-type: application/json');
		echo json_encode($article);
	}
	
	public function getPerPage($data){

		//get the current page number:
		$page = $data[0];
		$article = new Article();
		$articles = $article->getPerPage($page);
		
		http_response_code(200);
		
		header('Access-Control-Allow-Origin: *');
		header('Content-type: application/json');
		echo json_encode($articles);
	}
	
	public function getCount()
	{
		$article = new Article();
		$articles = $article->getArticleNumRows();
		http_response_code(200);
		header('Access-Control-Allow-Origin: *');
		header('Content-type: application/json');
		echo json_encode($articles);
	}
	
}