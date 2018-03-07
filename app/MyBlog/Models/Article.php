<?php

namespace MyBlog\Models;

class Article extends BaseModel
{
	private $id;
	private $title;
	private $content;
	private $created_at;
	private $user_id;
	
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