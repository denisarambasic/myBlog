<?php

namespace MyBlog\Models;

class Article extends BaseModel
{
	private $id;
	private $title;
	private $content;
	private $created_at;
	private $user_id;
	
	/*=== Update article ===*/
	public function updateArticle($article_id, $title, $content, $lat, $lng){
		$query = "UPDATE articles SET title= :title, content= :content, lat= :lat, lng= :lng WHERE id = :article_id";
		$stmt = $this->getConnection()->prepare($query);
		$stmt->bindParam('title', $title);
		$stmt->bindParam('content', $content);
		$stmt->bindParam('lat', $lat);
		$stmt->bindParam('lng', $lng);
		$stmt->bindParam('article_id', $article_id);
		return $stmt->execute();
	}
	
	/*=== Delete article by id ===*/
	public function deleteArticle($article_id)
	{
		$query = "DELETE FROM articles WHERE id = :article_id";
		$stmt = $this->getConnection()->prepare($query);
		$stmt->bindParam('article_id', $article_id);
		return $stmt->execute();
	}
	
	/*=== Check if the logged in user is the owner of an article ===*/
	public function isOwner($article_id, $user_id)
	{
		$query = "SELECT COUNT(*) AS is_owner FROM articles WHERE id = :article_id AND user_id = :user_id";
		$stmt = $this->getConnection()->prepare($query);
		$stmt->bindParam('article_id', $article_id);
		$stmt->bindParam('user_id', $user_id);
		$stmt->execute();
		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}
	
	/*=== Create a new Article ===*/
	public function createArticle($title, $content, $user_id, $lat, $lng)
	{
		$query = "INSERT INTO articles VALUES (NULL, :title, :content, NOW(), :user_id, :lat, :lng)";
		$stmt = $this->getConnection()->prepare($query);
		$stmt->bindParam('title', $title);
		$stmt->bindParam('content', $content);
		$stmt->bindParam('user_id', $user_id);
		$stmt->bindParam('lat', $lat);
		$stmt->bindParam('lng', $lng);
		try{
			$stmt->execute();			
		}catch(\Exception $e){
			echo $e->getMessage();
		}
	}
	
	/*=== GET Articles by user_id ===*/
	public function getByUserId($user_id){
		$query = "SELECT articles.id, articles.title, articles.content, articles.lat, articles.lng, articles.created_at, users.email FROM articles
					INNER JOIN users ON users.id = articles.user_id WHERE articles.user_id = :user_id";
		$stmt = $this->getConnection()->prepare($query);
		$stmt->bindParam('user_id', $user_id);
		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}
	
	/*=== GET the number of rows (articles) ===*/
	public function getArticleNumRows()
	{
		$query = "SELECT COUNT(*) AS num_rows FROM articles";
		$stmt = $this->getConnection()->prepare($query);
		$stmt->execute();
		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}
	/*=== GET five articles per page ===*/
	public function getPerPage($page)
	{
		$offset = ($page * 5) - 5;
		$query = "SELECT articles.id, articles.title, articles.content, articles.created_at, users.email FROM articles INNER JOIN users ON users.id = articles.user_id ORDER BY articles.created_at DESC LIMIT 5 OFFSET $offset";
		$stmt = $this->getConnection()->prepare($query);
		//$stmt->bindParam('offset', $offset);
		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
		
	}
	
	/*=== GET Article by id ===*/
	public function getById($id){
		$query = "SELECT articles.id, articles.title, articles.content, articles.lat, articles.lng, articles.created_at, users.email FROM articles
					INNER JOIN users ON users.id = articles.user_id WHERE articles.id = :id";
		$stmt = $this->getConnection()->prepare($query);
		$stmt->bindParam('id', $id);
		$stmt->execute();
		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}
	
	/*=== GET All Articles ===*/
	public function getAll()
	{
		$query = "SELECT articles.id, articles.title, articles.content, articles.created_at, users.email FROM articles
					INNER JOIN users ON users.id = articles.user_id ORDER BY articles.created_at DESC";
		$stmt = $this->getConnection()->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}
	
	/*=== GET THE LAST 3 Articles ===*/
	public function getLast3()
	{
		$query = "SELECT articles.id, articles.title, articles.content, articles.created_at, users.email FROM articles
					INNER JOIN users ON users.id = articles.user_id ORDER BY articles.created_at DESC LIMIT 3";
		$stmt = $this->getConnection()->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}
	
	/*=== Getter for Id ===*/
	public function getId()
	{
		return $this->id;
	}
	
	/*=== Getter and Setter for Title ===*/
	public function getTitle()
	{
		return $this->title;
	}
	
	public function setTitle($title)
	{
		$this->title = $title;
	}
	
	/*=== Getter and Setter for Content ===*/
	public function getContent()
	{
		return $this->content;
	}
	
	public function setContent($content)
	{
		$this->content = $content;
	}

	/*=== Getter and Setter for Created_at ===*/
	public function getCreated_at()
	{
		return $this->created_at;
	}
	
	public function setCreated_at($created_at)
	{
		$this->created_at = $created_at;
	}
	
	/*=== Getter and Setter for User_id ===*/
	public function getUser_id()
	{
		return $this->user_id;
	}
	
	public function setUser_id($user_id)
	{
		$this->user_id = $user_id;
	}
	
}