<?php

namespace MyBlog\Models;

class BaseModel
{
	private $pdoDriver 	= 'mysql';
	private $host		= 'localhost';
	private $username	= 'root';
	private $password	= 'xxx';
	private $database	= 'amvc4';
	private $charset	= 'utf8';
	private $conn		= null;
	
	public function __construct()
	{
		$dsn = $this->pdoDriver . ':host=' . $this->host . ';dbname=' . $this->database . ';charset=' . $this->charset;
		
		try{
			$this->conn = new \PDO($dsn, $this->username, $this->password);
			$this->conn->setAttribut(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}catch(\Exception $e){
			echo $e->getMessage();
			exit;
		}
		
	}
	
	public function getConnection()
	{
		return $this->conn;
	}
	
}
