<?php

namespace MyBlog\Models;

class User extends BaseModel
{
	private $id;
	private $email;
	private $password;
	private $created_at;
	
	/*=== Add a new user ===*/
	public function registerUser($email, $password)
	{
		$query = "INSERT INTO users VALUES (NULL, :email, :password, NOW())";
		$stmt = $this->getConnection()->prepare($query);
		$stmt->bindParam('email', $email);
		$stmt->bindParam('password', $password);
		return $stmt->execute();
	}
	
	/*=== Get user by email ===*/
	public function getUserByEmail($email)
	{
		$query = "SELECT * FROM users WHERE email = :email";
		$stmt = $this->getConnection()->prepare($query);
		$stmt->bindParam('email', $email);
		$stmt->execute();
		return $stmt->fetch(\PDO::FETCH_ASSOC);
	}
	
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