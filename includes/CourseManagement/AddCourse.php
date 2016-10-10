<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class AddCourse
{
    private $title;
    private $hours;
    private $program;
    private $batch;

    Private $Result;
	function __construct()
	{
        $this->title    = $_POST['title'];
        $this->hours    = $_POST['hours'];
        $this->program  = $_POST['program'];
        $this->batch    = $_POST['batch'];
    }
    public function add()
    {	
    	global $database;
        


        $Query = "INSERT INTO course (c_title,c_hours,c_id,program,batch) VALUES ('$this->title','$this->hours',1,'$this->program','$this->batch') ";
        $result = $database->query($Query);
        if($result)
        {
            
            $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Course Created</div>";
            header("Location: ../../user/newCourse.php");
        
        }
        else 
        {
            $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Error!</div>";
            header("Location: ../../user/newCourse.php");
               
        }  
        
        
    }  
}
$MyOBJECT = new AddCourse;
$MyOBJECT->add();

?>