<?php

namespace Newtask;

class db{
	
	private $dsn;
	private $pdo;
	private static $instance;
	private $host;
	private $userName;
	private $password;
	private $dbName;
	private $charSet;
	
	function __construct(){
		
		echo "<br/> run db";
	}
	
	public function connect(){
		$this->serverName="localhost";		
		$this->userName="root";		
		$this->password="";		
		$this->dbName="newtask";	
		$this->charSet="utf8";	
		try{
			$dsn="mysql:host=".$this->host.";dbname=".$this->dbName.";charset=".$this->charSet;
			$pdo=new \pdo($dsn, $this->userName, $this->password);
			$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			return $pdo;
			
		}catch(PDOException $e){
			echo "DB ERROR: ".$e->getMessage();
		}//end try catch
	}//end 

}


?>