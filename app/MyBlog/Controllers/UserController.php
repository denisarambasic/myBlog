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
		$message = ["message" => "To create a new article you need to be logged in and send a post req with params ['title', 'content', 'lat', 'lng']"];
		echo json_encode($message);
	}
	
	public function createArticle()
	{
		
		header('Access-Control-Allow-Origin: *');
		header('Content-type: application/json');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
		$user_id = Authentication::requireAuth();
		$data = file_get_contents('php://input');
		$data = json_decode($data);
		//filter input 
		$title = filter_var($data->title, FILTER_SANITIZE_STRING);
		$content = filter_var($data->content, FILTER_SANITIZE_STRING);
		
		/*== Latitude and longitude for google map ==*/
		$lat = filter_var($data->lat, FILTER_VALIDATE_FLOAT);
		$lng = filter_var($data->lng, FILTER_VALIDATE_FLOAT);
		
		$article = new Article();
		$article->createArticle($title, $content, $user_id, $lat, $lng);
		
		http_response_code(201);		
		$message = ["message" => "A new article was created"];
		echo json_encode($message);
		
	}
	
	public function deleteArticle($data)
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: DELETE');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
		//1.get the user_id of the current user
		$user_id = Authentication::requireAuth();
		$article_id = $data[0];
		
		//check if the article belongs to the current user
		$article = new Article();

		$article_owner = $article->isOwner($article_id, $user_id);
		//if the article dont belongs to the user stop script
		if(!$article_owner['is_owner']){
			$message = ["error" => "You have no permission"];
			echo json_encode($message);
			exit;
		}
		
		//if the article belongs to the current user delete it from the DB
		$article->deleteArticle($article_id);
		$message = ["success" => "Article deleted"];
		echo json_encode($message);
		exit;
	}
	
	public function updateArticle($data)
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: PUT');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
		//1.get the user_id of the current user
		$user_id = Authentication::requireAuth();
		$article_id = $data[0];
		
		//check if the article belongs to the current user
		$article = new Article();

		$article_owner = $article->isOwner($article_id, $user_id);
		//if the article dont belongs to the user stop script
		if(!$article_owner['is_owner']){
			$message = ["error" => "You have no permission"];
			echo json_encode($message);
			exit;
		}
		
		//if the article belongs to the current user update it
		
		$data = file_get_contents('php://input');
		$data = json_decode($data);
		
		//filter input 
		$article_id = filter_var($data->id, FILTER_SANITIZE_NUMBER_INT);
		$title = filter_var($data->title, FILTER_SANITIZE_STRING);
		$content = filter_var($data->content, FILTER_SANITIZE_STRING);
		
		/*== Latitude and longitude for google map ==*/
		$lat = filter_var($data->lat, FILTER_VALIDATE_FLOAT);
		$lng = filter_var($data->lng, FILTER_VALIDATE_FLOAT);

		$article->updateArticle($article_id, $title, $content, $lat, $lng);
		$message = ["success" => "Article updated"];
		echo json_encode($message);
		exit;
	}
	
}