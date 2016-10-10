<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class RejectStudentRequest
{
    
    private $sr_id;
    Private $Result;
	function __construct()
	{
        $this->sr_id     = $_POST['sr_id'];
    }
    public function reject()
    {	
    	global $database;
        $this->sr_id      = $database->escape_value($this->sr_id);


        $Query = "DELETE FROM student_request WHERE sr_id='$this->sr_id' ";
        $result = $database->query($Query);
        if ($result) 
        {
            $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Request Deleted</div>";
            header("Location: ../../user/course.php");
        }
        else 
        {
            $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Error!</div>";
            header("Location: ../../user/course.php");
        }
    }  
}
$MyOBJECT = new RejectStudentRequest;
$MyOBJECT->reject();

?>