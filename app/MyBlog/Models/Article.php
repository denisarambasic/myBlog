<?php

namespace MyBlog\Models;

class Article extends BaseModel
{
	private $id;
	private $title;
	private $content;
	private $created_at;
	private $user_id;
	
	/*=== GET All Articles ===*/
	public function getAll()
	{
		$query = "SELECT articles.title, articles.content, articles.created_at, users.email FROM articles
					INNER JOIN users ON users.id = articles.user_id ORDER BY articles.created_at DESC";
		$stmt = $this->getConnection()->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}
	
	/*=== GET THE LAST 3 Articles ===*/
	public function getLast3()
	{
		$query = "SELECT articles.title, articles.content, articles.created_at, users.email FROM articles
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