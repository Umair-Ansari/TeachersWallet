<?php
if(session_id() == '') {
    session_start();
}
require_once("../database.php");
class AcceptStudentRequest
{
    
    private $sr_id;
    Private $c_code;
    Private $u_id;
    Private $cf_id;
    Private $Result;
	function __construct()
	{
        $this->sr_id     = $_POST['sr_id'];
    }
    public function accept()
    {	
    	global $database;
        $this->sr_id      = $database->escape_value($this->sr_id);


        $Query = "SELECT * FROM student_request WHERE sr_id='$this->sr_id' ";
        $result = $database->query($Query);
        if($row = mysqli_fetch_assoc($result))
        {
            $this->c_code   = $row['c_code'];
            $this->u_id     = $row['u_id'];

            $Query2 = "SELECT cf_id FROM course_file WHERE c_code='$this->c_code'";
            $result2 = $database->query($Query2);
            if($row2 = mysqli_fetch_assoc($result2))
            {
                $this->cf_id = $row2['cf_id'];

                $Query = "INSERT INTO course_student (c_id,u_id) VALUES ('{$this->cf_id}','{$this->u_id}') ";
                $result = $database->query($Query);
                if ($result) 
                {
                    $Query = "DELETE FROM student_request WHERE sr_id='$this->sr_id' ";
                    $result = $database->query($Query);
                    if ($result) 
                    {
                        $_SESSION["Message"] = "<div style='background-color:#BCF6BC;border:1px solid green;padding:7pt;'>Request Accepted</div>";
                        header("Location: ../../user/course.php");
                    }
                    else 
                    {
                        $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Error!</div>";
                        header("Location: ../../user/course.php");
                    }
                }
                else 
                {
                    $_SESSION["Message"] = "<div style='background-color:#ffebe8;border:1px solid #dd3c10;padding:7pt;'>Error!</div>";
                    header("Location: ../../user/course.php");
                }
            }
            
        }  
        
        
    }  
}
$MyOBJECT = new AcceptStudentRequest;
$MyOBJECT->accept();

?>