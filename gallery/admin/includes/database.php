<?php



class Database
{
	public $con;
	
	function __construct()
	{
		$this->open_db_connection();
	}
	
	public function open_db_connection()
	{
		$this->con= new mysqli('localhost','root','','gallery_db');
		
		if($this->con->connect_errno)
		{
			die("connection failed".$this->con->connect_error);
		}
	}
	
	public function query($sql)
	{
		$result=$this->con->query($sql);
		
		return $result;
	}
	
	private function confirm_query($result)
	{
		if(!$result)
		{
			die("Query Failed". $this->con->error);
		}
	}
	
	public function escape_string($string)
	{
		$escaped_string=$this->con->real_escape_string($string);
		
		return $escaped_string;
	}
	
	public function the_insert_id()
	{
		return mysqli_insert_id($this->con);
	}
	
	
}
$database=new Database();


	
	
	
	
 ?>