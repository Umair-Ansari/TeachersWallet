<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");

class Login
{
	private $email;
	private $password;
    Private $Result;
	function __construct()
	{
		$this->email      = $_POST["email"];
		$this->password   = $_POST["password"];
	}
    public function authenticate()
    {	
    	global $User_Management;

    	$this->email       = trim($this->email);
    	$this->password    = trim($this->password);

    	if($this->email == null || $this->password == null)
    	{
    		$_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;margin: -20pt 0pt 0pt 0pt;'><b>Please re-enter your missing information.</div>";
            header("Location: index.php");
    	}
    	else
    	{
    		global $database;

            $this->email      = $database->escape_value($this->email);
            $this->password   = $database->escape_value($this->password);

            $Query  = "SELECT * ";
            $Query .= "FROM user ";
            $Query .= "WHERE email='{$this->email}' "; 
            $Query .= "AND password='{$this->password}' ";
                    
            $result = $database->query($Query);
            
            if ( $row = mysqli_fetch_assoc($result)) 
            {
                $_SESSION["user"]   = $row['u_id'];
                $role               = $row['r_id'];
                $_SESSION["fname"]  = $row['fname'];
                $_SESSION["lname"]  = $row['lname'];
                $Query_role = "SELECT role FROM role WHERE r_id = '".$role."' ";
                $result2 = $database->query($Query_role);
                if ( $row2 = mysqli_fetch_assoc($result2))
                {
                    $_SESSION["role"] = $row2['role'];
                }
                header("Location: ../../user/index.php");
            }
             
            else 
            {
                $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;margin: -35pt 0pt -8pt;'><b>Please re-enter your password</b><br><br>The password you entered is incorrect. Please try again (make sure your caps lock is off).<br><br>Forgot your password? <a href='forget.php' style='color:#6159b2;'>Request a new one</a>.</div>";
                header("Location: ../../index.php");
            }
            
    	}
    	

        return $this->Result;
    }  
}
$MyOBJECT = new Login;
$MyOBJECT->authenticate();

?>