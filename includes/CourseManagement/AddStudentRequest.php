<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class AddStudentRequest
{
    
    private $u_id;
    Private $c_code;

    Private $Result;
	function __construct()
	{
        $this->u_id    = $_POST['u_id'];
        $this->c_code    = $_POST['c_code'];
    }
    public function add()
    {	
    	global $database;
        


        $Query = "INSERT INTO student_request (u_id,c_code) VALUES ($this->u_id,$this->c_code) ";
        $result = $database->query($Query);
        if($result)
        {
            
            $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Request Send! You can review your send request <a href='courseRequests.php'>here</a></div>";;
            header("Location: ../../user/addCourse.php");
        
        }
        else 
        {
            $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Error!</div>";
            header("Location: ../../user/addCourse.php");
               
        }  
        
        
    }  
}
$MyOBJECT = new AddStudentRequest;
$MyOBJECT->add();

?>