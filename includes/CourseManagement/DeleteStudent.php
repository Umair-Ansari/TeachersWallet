<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class DeleteStudent
{
    
    Private $user;
    Private $course;
    Private $Result;
	function __construct()
	{
        $this->user         = $_POST['user'];
        $this->course       = $_POST['course'];
    }
    public function delete()
    {	
    	global $database;
      


        $Query = "DELETE FROM course_student WHERE c_id='$this->course' AND u_id ='$this->user'  ";
        $result = $database->query($Query);
        if ($result) 
        {
            $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Student Removed</div>";
            header("Location: ../../user/students.php?course=$this->course");
            die();
        }
        else 
        {
            $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Error!</div>";
            header("Location: ../../user/students.php?course=$this->course");
        }
          
        
        
    }  
}
$MyOBJECT = new DeleteStudent;
$MyOBJECT->delete();

?>