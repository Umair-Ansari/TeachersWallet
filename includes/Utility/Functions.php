<?php


if(session_id() == '') {
    session_start();
}
require_once("../UserManagement/UserManagementDL.php");
class Functions
{
	private $fname; 	
	private $lname; 		
	private $r_id;

	public function HOME()
	{

		$_SESSION["HOME"] = "http://localhost/TW/";
		$_SESSION["DIR"] = 'C:/wamp/www/TW/';
	}
	public function LogOut()
	{
		$home = $_SESSION["HOME"];
		$destry = session_destroy();
		if ($destry == true) 
		{
			$_SESSION["DIR"] = 'C:/wamp/www/TW/';
			header("Location: ".$home."index.php");
		} else 
		{
			$_SESSION["DIR"] = 'C:/wamp/www/TW/';
			$_SESSION["HOME"] = $home;
		}
		
	}
	public function ViewProfile()
	{
		 global $User_Management;

		 $result = $User_Management->ViewProfile();
		 if ( $row = mysqli_fetch_assoc($result)) 
		{
			$this->fname 	= $row['fname'];
			$this->lname 	= $row['lname'];
			$this->r_id 	= $row['r_id'];
			
		}
		
	}
}

$Utility = new Functions;

?>