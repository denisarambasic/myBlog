<?php

namespace MyBlog\Models;

class User extends BaseModel
{
	private $id;
	private $email;
	private $password;
	private $created_at;
	
	/*=== Getter for Id ===*/
	public function getId()
	{
		return $this->id;
	}
	
	/*=== Getter and Setter for Email ===*/
	public function getEmail()
	{
		return $this->email;
	}
	
	public function setEmail($email)
	{
		$this->email = $email;
	}
	
	/*=== Getter and Setter for Password ===*/
	public function getPassword()
	{
		return $this->password;
	}
	
	public function setPassword($password)
	{
		$this->password = $password;
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
	
}