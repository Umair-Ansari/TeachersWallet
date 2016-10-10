<?php
require_once("config.php");

class MySQLDatabase
{
	private $connection;
	private $magic_quotes_active;
	private $real_escape_string_exists;

	public $last_query;

	function __construct()
	{
		$this->open_connection();
		$this->magic_quotes_active = get_magic_quotes_gpc();
		$this->real_escape_string_exists = function_exists("mysql_real_escape_string");
	}
	public function open_connection()
	{
		$this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		if(!$this->connection)
		{
			die("Database connection failed : ".mysql_error());
		}
		
	}
	public function close_connection()
	{
		if (isset($this->connection)) 
		{
			mysql_close($this->connection);
			unset($this->connection);
		}
	}
	public function query($query)
	{
		$this->last_query = $query;
		$result = mysqli_query($this->connection,$query);
		$this->confrm_query($result);
		return $result;

	}
	private function confrm_query($result)
	{
		if(!$result)
		{
			$output = "Database query failed : ".mysql_error(). "<br /><br />";
			$output .= "Last Query : ".$this->last_query;
			die($output);
		}
	}
	public function escape_value( $value ) {
		
		if($this->real_escape_string_exists)
		{
			if($this->magic_quotes_active)
			{
				$value = stripcslashes($value);
			}
			$value = mysqli_real_escape_string($this->connection,$value);
		}
		else
		{
			if(!$this->magic_quotes_active)
			{
				$value = addcslashes($value);
			}
		}
		return $value;
	}
	public function fetch_array($result_set)
	{
		return mysql_fetch_array($result_set);
	}
	public function num_rows($result_set)
	{
		return mysql_num_rows($result_set);
	}
	public function insert_id()
	{
		return mysql_insert_id($this->connection);
	}
	public function affected_rows()
	{
		return mysql_affected_rows($this->connection);
	}
}

$database = new MySQLDatabase();
?>