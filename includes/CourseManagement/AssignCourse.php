<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class AssignCourse
{
    private $u_id;
    private $c_code;

    Private $Result;
	function __construct()
	{
        $this->c_code    = $_POST['c_code'];
        $this->u_id    = $_POST['u_id'];
    }
    public function assign()
    {	
    	global $database;
        if(($this->c_code == null) || ($this->u_id == null) )
        {
            $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Cant not assign</div>";
            header("Location: ../../user/newCourse.php");
            die();
        }

        $Query = "SELECT count(*) row FROM course_file WHERE u_id = '$this->u_id' AND c_code = '$this->c_code' ";
        $result = $database->query($Query);
        if($row = mysqli_fetch_assoc($result)) 
        {
            if($row['row'] > 0)
            {
                $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Cant not assign same course with same batch to this teacher</div>";
                header("Location: ../../user/newCourse.php");
                die();
            }
        }

        $Query = "INSERT INTO course_file (u_id,c_code) VALUES ('$this->u_id','$this->c_code') ";
        $result = $database->query($Query);
        if($result)
        {
            $Query = "INSERT INTO information (cf_id) VALUES ((SELECT LAST_INSERT_ID())) ";
            $result = $database->query($Query);
            if($result)
            {

            }
            $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Course Assigned!</div>";;
            header("Location: ../../user/newCourse.php");
        
        }
        else 
        {
            $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Error!</div>";
            header("Location: ../../user/newCourse.php");
               
        }  
        
        
    }  
}
$MyOBJECT = new AssignCourse;
$MyOBJECT->assign();

?>